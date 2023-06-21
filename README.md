# Post Initial Interview Tasks

As part of the interview process, we'd like you to attempt one of the following tasks.

Although it can't be monitored by us, we'd like you to spend no longer than 90 minutes on the task you choose.

The goal is to assess how you percieve the task and attempt it, and to allow us to see the kind of code that you produce, you are not marked down for not finishing the task in this timefame.

A sample project for you to start from is available at [GitHub](https://github.com/jamessessford/post-initial-interview-tasks).

To get started, clone the project and once you've completed the 90 minutes, open a Pull Request to the project with your changes.

The sample project is a [Laravel](https://laravel.com) Skeleton application with [Breeze](https://laravel.com/docs/10.x/starter-kits#laravel-breeze) installed as well as a seeder to fill the users table.

```Users``` are seperated into the following types:

    Admin
    Staff
    Developer

## Complaints

A system to record and view complaints received by Preferred Management.

A ```Complaint``` can fall into either of the following categories:

    Complaint
    Dissatisfaction

A ```Complaint``` can be in one the following statuses:

    Not acknowledged
    Pending investigation
    Under investigation
    Resolved & justified
    Resolved & unjustified

A ```Complaint``` status should only be able to move in the following transitions:

    Not acknowledged -> Pending investigation
    Pending investigation -> Under Investigation
    Under investigation -> Resolved & justified
    Under investigation -> Resolved & unjustified

A ```Complaint``` status can be updated by any ```User``` until it's under investigation but can only only be updated after that point by an ```Admin```.

A ```Complaint``` can be created by any ```User```.

A ```Complaint``` should be made up of the following:

    Date of complaint
    User logging the complaint
    A complaint summary
    Full complaint body
    Complaint status

A ```Complaint``` should be able to have ```Notes``` attached to it by any ```Staff``` or ```Admin``` at any point in it's lifecycle.

The ```Notes``` should also contain the user that has logged the note.

## Kanban

A system to record work tasks for the Preferred Management development team.

A ```Task``` can fall into either of the following categories:

    Bug
    Feature

A ```Task``` can have the following statuses:

    Not acknowledged
    Approved
    In progress
    In testing
    Complete

A ```Task``` status should only be able to move in the following transitions:

    Not acknowledged -> Approved
    Approved -> In progress
    In progress -> In testing
    In testing -> In progress
    In testing -> Complete

A ```Task``` status can be updated by any ```Developer``` but can only be marked as Complete by an ```Admin```.

A ```Task``` should be made up of the following:

    User logging the task
    Task details
    Due date
    Hours required
    Developer assigned to the task

A ```Task``` should be able to have ```Notes``` attached to it by any ```User``` type at any point in it's lifecycle.

The ```Notes``` should also contain the user that has logged the note.
