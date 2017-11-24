<h1>Új időpont foglalási igény érkezett!</h1>
<div class="" style="color: red;">
  A jelentkezőt értesíteni kell a megadott elérhetőségek egyikén a szolgáltatás időpont lefoglalással kapcsolatban.
</div>
<br>
<div class="">
Név: <strong><?php echo $name; ?></strong>
</div>
<div class="">
Telefonszám: <strong><?php echo $phone; ?></strong>
</div>
<?php if (!empty($email)): ?>
<div class="">
E-mail: <strong><?php echo $email; ?></strong>
</div>
<?php endif; ?>
<div class="">
--
</div>
<div class="">
Választott szolgáltatás: <strong><?php echo $szolgaltatas; ?></strong>
</div>
<div class="">
Választott időpont: <strong><?php echo $date; ?></strong>
</div>
<div class="">
--
</div>
<?php if (!empty($uzenet)): ?>
  <div class="">
  Üzenet: <br>
  <strong><?php echo $uzenet; ?></strong>
  </div>
<?php endif; ?>
-- <br>
<div class="">
  Jelentkezés leadásának ideje: <em><?php echo date('Y-m-d H:i:s'); ?></em>
</div>
-------- <br>
Küldve a(z) <strong><?php echo get_option('blogname'); ?></strong> weboldal <strong>Időpont foglalási rendszerével</strong>.
