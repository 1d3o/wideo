<div class='wrap'>

  <h1>Contatti</h1>

  <?php if (current_user_can('administrator')) : ?>

    <div class="card" style="max-width: 100%;">
      <h2>Guida</h2>
      <p>
      I settaggi permettono di gestire e configurare facilmente mailer per i form.
      </p>

      <h4>Utilizzo</h4>
      <p>Iserire la configurazione delle impostazioni:</p>
      <div>
      <pre>
function wideo_mailer_initialize() {
  return array(
    'form_1' => array(
      'debug' => false,
      'params' => ['name', 'surname', 'email', 'phone', 'object', 'message'],
      'params_required' => ['name', 'surname', 'email'],
      'mail_to' => 'test@mail.com',
      'mail_subject' => 'New email from'
    )
  );
}
      </pre>
      </div>
      <br>
      <p>I form implementati possono a quel punto inviare richieste POST al file api.php contenuto all'interno del plugin.</p>
      <p>Le richieste devono contenere un parametro "_form" che specifica il nome del form configurato che si vuole utilizzare.</p>
    </div>

  <?php endif; ?>

</div>