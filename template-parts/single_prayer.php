<div class="prayer">
  <div class="single">
    <?php $next_prayer = get_next_prayer(); ?>
    <div class="name"><?php echo $next_prayer['name']; ?></div>
    <div class="time"><?php echo $next_prayer['time']; ?></div>
  </div>
</div>
