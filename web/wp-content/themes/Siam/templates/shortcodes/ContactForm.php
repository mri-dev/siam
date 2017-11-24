<a name="_form"></a>
<div class="group-holder">
  <form id="mailsend" action="" method="post">
    <div class="flxtbl">
      <div class="name">
        <label for="name">Név *</label>
        <div class="form-input-holder">
          <input type="text" id="name" name="name" class="form-control" value="">
        </div>
      </div>
      <div class="email">
        <label for="email">E-mail cím</label>
        <div class="form-input-holder">
          <input type="text" id="email" name="email" class="form-control" value="">
        </div>
      </div>
      <div class="phone">
        <label for="phone">Telefonszám *</label>
        <div class="form-input-holder">
          <input type="text" id="phone" name="phone" class="form-control" value="">
        </div>
      </div>
      <?php
        $posts = new WP_Query(array(
          'post_type' => 'szolgaltatas',
          'orderby' => 'menu_order',
          'order' => 'ASC'
        ));
      ?>
      <div class="szolgaltatas">
        <label for="szolgaltatas">Szolgáltatás *</label>
        <div class="form-input-holder">
          <select class="form-control" name="szolgaltatas" id="szolgaltatas">
            <option value="" selected="selected">-- válasszon --</option>
            <?php while( $posts->have_posts() ): $posts->the_post(); ?>
              <option value="<?php echo the_title(); ?>" <?=(isset($_GET['sz']) && $_GET['sz'] == get_the_title())?'selected="selected"':''?>><?php echo the_title(); ?></option>
            <?php endwhile; wp_reset_postdata(); ?>
          </select>
        </div>
      </div>
      <div class="idopont">
        <label for="datetimepicker">Mikorra szeretne bejelentkezni?</label>
        <div class='input-group date' id='datetimepicker'>
            <input type='text' class="form-control" name="date" readonly="readonly"/>
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
            </span>
        </div>
        <div class="itext">
          A naptár jelre kattintva kiválaszthatja az időpontot.
        </div>
      </div>
      <div class="uzenet">
        <label for="uzenet">Megjegyzés</label>
        <div class="form-input-holder">
          <textarea name="uzenet" id="uzenet" class="form-control"></textarea>
        </div>
      </div>
      <div class="recaptcha">
        <div class="g-recaptcha" data-sitekey="<?=CAPTCHA_SITE_KEY?>"></div>
      </div>
      <div class="btns">
        <div id="mail-msg" style="display: none;">
          <div class="alert"></div>
        </div>
        <button type="button" id="mail-sending-btn" onclick="ajanlatkeresKuldes();">Foglalási igény küldése</button>
        <div class="accept-text">
          Az igény elküldése nem tekinthető foglalásnak. Minden esetben visszaigazoljuk, amint a foglalás érvényesítve lett!
        </div>
      </div>
    </div>
  </form>
</div>
<script type="text/javascript">
var mail_sending_progress = 0;
var mail_sended = 0;
function ajanlatkeresKuldes()
{
  if(mail_sending_progress == 0 && mail_sended == 0){
    jQuery('#mail-sending-btn').html('<?php echo __('Időpont foglalás folyamatban', 'Avada'); ?> <i class="fa fa-spinner fa-spin"></i>').addClass('in-progress');
    jQuery('#mailsend .missing').removeClass('missing');

    mail_sending_progress = 1;
    var mailparam  = jQuery('#mailsend').serializeArray();
    jQuery.post(
      '<?php echo admin_url('admin-ajax.php'); ?>?action=contact_form',
      mailparam,
      function(data){
        var resp = jQuery.parseJSON(data);
        console.log(resp);
        if(resp.error == 0) {
          mail_sended = 1;
          jQuery('#mail-sending-btn').html('<?php echo __('A jelentkezés elküldve', 'Avada'); ?> <i class="fa fa-check-circle"></i>').removeClass('in-progress').addClass('sended');
        } else {
          jQuery('#mail-sending-btn').html('<?php echo __('Foglalási igény küldése', 'Avada'); ?>').removeClass('in-progress');
          jQuery('#mail-msg').show();
          jQuery('#mail-msg .alert').html(resp.msg).addClass('alert-danger');
          mail_sending_progress = 0;
          if(resp.missing != 0) {
            jQuery.each(resp.missing_elements, function(i,e){
              jQuery('#mailsend #'+e).addClass('missing');
            });
          }
        }
      }
    );
  }
}
(function($){
  $('#datetimepicker').datetimepicker({
    format: 'YYYY.MM.DD. HH:mm',
    dayViewHeaderFormat: 'YYYY. MMMM',
    sideBySide: true,
    locale: 'hu',
    stepping: 15,
    allowInputToggle: true,
    ignoreReadonly: true,
    minDate: '<?=date('Y-m-d', strtotime('+1 day'))?> 12:00:00',
    enabledHours: [10, 11, 12, 13, 14, 15, 16, 17, 18, 19],
    defaultDate: '<?=date('Y-m-d', strtotime('+1 day'))?> 12:00:00'
    });
})(jQuery);
</script>
