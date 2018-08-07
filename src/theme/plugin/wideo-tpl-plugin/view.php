<div class='wrap'>

  <h1>Settaggi</h1>

  <?php if ($initialize_missing) : ?>

    <div class="notice notice-warning">
      <p>Il plugin di gestione settaggi non è stato configurato.</p>
    </div>

  <?php else : ?>

    <?php if($flash_completed) : ?>
      <div class="notice notice-success is-dismissible">
        <p>Le impostazioni sono state correttamente aggiornate.</p>
      </div>
    <?php endif; ?>

    <form method="POST">
      <table class="form-table">
          <tbody>
            <?php foreach($settings as $key => $value) : ?>
              <?php if (!$value['only_admin'] || current_user_can('administrator')) : ?>
                <tr>
                  <th scope="row">
                    <label for="my-text-field"><?php echo $value['label']; ?>:</label>
                  </th>
                  <td>
                    <input type="text" style="width: 100%;" name="tpl_<?php echo $key; ?>" value="<?php echo get_option("tpl_$key"); ?>">
                  </td>
                </tr>
              <?php endif; ?>
            <?php endforeach; ?>
          </tbody>
      </table>
      <p class="submit">
        <input type="submit" value="Aggiorna impostazioni" class="button-primary" name="Submit">
      </p>
    </form>

  <?php endif; ?>

  <?php if (current_user_can('administrator')) : ?>

    <div class="wideo-box">
      <h2>Guida</h2>
      <p>
      I settaggi permettono di definire e accedere facilmente a impostazioni globali del template.
      Le impostazioni, una volta configurate, possono essere lette in qualsiasi punto del template e del backoffice atraverso l'uso della funzione <i>get_option()</i> di Wordpress.
      </p>

      <h4>Utilizzo</h4>
      <p>Iserire la configurazione delle impostazioni:</p>
      <div class="wideo-code">
<pre>
function wideo_tpl_initialize() {
  return array(
    'setting_key' => array(
      'label' => 'Setting label',
      'only_admin' => true
    ),
  );
}
</pre>
      </div>
      <br>
      <p>Ottenere il valore di una impostazione:</p>
      <div class="wideo-code">
<pre>
echo get_option('tpl_setting_key');
</pre>
      </div>
    </div>

  <?php endif; ?>

</div>
