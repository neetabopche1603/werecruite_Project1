<h1>Hi, <?php echo $name; ?></h1>
<p>This is your Interview Timings please confirm by clicking confirm button.</p>
<p>Date : <?= $date; ?></p>
<p>Time : <?= $time; ?></p>
{{-- <p>schedule_id : <?= $schedule_id; ?></p> --}}
<a href="{{route('admin.scheduleInterviewConfirm',['id'=>$schedule_id])}}">Confirm Interview</a>
<a href="{{route('admin.scheduleInterviewCancel',['id'=>$schedule_id,'user_id'=>$user_id])}}">Cancel Interview</a>
