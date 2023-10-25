<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Parental\HasChildren;

class User extends Authenticatable
{
    use HasApiTokens, HasChildren, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'type',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    function raiseComplaint($summary, $body, $complaintType)
    {
        //"db" in queries for a sample pointer to a database
        // 1 if complaint 2 if dissatisfaction
        $summary = mysqli_real_escape_string("db",$summary);
        $body = mysqli_real_escape_string("db",$body);
        $type = mysqli_real_escape_string("db",$complaintType);
        mysqli_query("db","INSERT INTO complaints ('date','user', 'summary','body', 'type', 'status') VALUES (time(), $this->fillable['type'], $summary, $body, $type, 1)");
    }

    function raiseTask($details, $dueDate, $hoursRequired, $developer, $type)
    {
        $details = mysqli_real_escape_string("db", $details);
        $dueDate = mysqli_real_escape_string("db", $dueDate);
        $hoursRequired = mysqli_real_escape_string("db", $hoursRequired);
        $developer = mysqli_real_escape_string("db", $developer);

        mysqli_query("db", "INSERT INTO developmentTasks (details,dueDate,hoursRequired,developer,type,raisedBy,state) VALUES ($details,$dueDate,$hoursRequired,$developer,$type.$this->fillable['user'],1)");

    }
    function updateTaskStatus($taskId, $newStatus)
    {
        $status = mysqli_fetch_array(mysqli_query("db", "SELECT status from developmentTasks WHERE taskId = $taskId"));
        if($this->fillable['type'] == "Staff")
        {
            Throw new Exception("You dont have permission to use this function");
        }
        else if($status['status'] <= 3 && ($newStatus == $status['status'] +1) && $this->fillable['type'] == "Developer")
        {
            mysqli_query("db", "UPDATE developmentTasks SET status = $newStatus WHERE taskId = $taskId");
            return true;
        }
        elseif($status['status'] == 4 && $this->fillable['type'] == "Admin" && $newStatus > $status['status'] && $newStatus <=5)
        {
            mysqli_query("db","UPDATE developmentTasks SET status = $newStatus WHERE taskId = $taskId");
            return true;
        }
        else
        {
            Throw new Exception("Something went wrong with this request");
        }
    }
    function logNoteForTask($taskId, $noteText)
    {
        $noteText = mysqli_real_escape_string("db", $noteText);
        mysqli_query("db", "INSERT INTO taskNotes ('taskId' , 'user', 'noteText') VALUES ($taskId, $this->fillable['user'], $noteText)");
    }

    function logNoteForComplaint($complaintId, $note)
    {
        if ($this->fillable['type'] == "Developer") {
            throw new Exception("Developers can't update notes");
        } else {
            $note = mysqli_real_escape_string($note);
            mysqli_query("db", "INSERT INTO complaintNotes ('complaintId', 'user', 'note' ) VALUES ($complaintId, $this->fillable['user'], $note)");
        }
    }

    function updateComplaint($complaintId, $newStatus)
    {
        //state 1 = not acknowledged
        //2 - pending investigation etc this would be understood with a link table
        $status = mysqli_fetch_array(mysqli_query("db", "SELECT status from complaints WHERE complaintId = $complaintId"));
        if($status['status'] <= 2 && ($newStatus == $status['status'] +1))
        {
            mysqli_query("db", "UPDATE complaints SET status = $newStatus WHERE complaintId = $complaintId");
            return true;
        }
        elseif($status['status'] == 3 && $this->fillable['type'] == "Admin" && $newStatus > $status['status'] && $newStatus <=5)
        {
            mysqli_query("db","UPDATE complaints SET status = $newStatus WHERE complaintId = $complaintId");
            return true;
        }
        else
        {
            Throw new Exception("Something went wrong with this request");
        }

    }
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
