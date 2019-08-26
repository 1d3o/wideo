<div class='wrap'>

  <h1>Settaggi</h1>

  <?php if ($initialize_missing) : ?>

    <div class="notice notice-warning">
      <p>Il plugin di gestione settaggi non è stato correttamente configurato.</p>
    </div>

  <?php else : ?>

    <?php if($flash_completed) : ?>
      <div class="notice notice-success is-dismissible">
        <p>Le impostazioni sono state correttamente aggiornate.</p>
      </div>
    <?php endif; ?>

    <div class="card" style="max-width: 100%;">

      <form method="POST">
        <table class="form-table">
            <tbody>
              <?php foreach($settings as $key => $value) : ?>
                <?php if (!$value['only_admin'] || current_user_can('administrator')) : ?>
                  <tr>
                    <th scope="row">
                      <label for="my-text-field"><?php echo $value['label']; ?>:</label><br>
                      <?php if ($value['only_admin']) : ?>
                      <small>Opzione da amministratore</small>
                      <?php endif; ?>
                    </th>
                    <td>
                      <?php if ($value['type'] == 'select') : ?>
                        <select style="width: 100%;" name="tpl_<?php echo $key; ?>" value="<?php echo get_option("tpl_$key"); ?>">
                          <?php foreach ($value['select_options'] as $option) : ?>
                            <option value="<?php echo $option; ?>" <?php echo $option == get_option("tpl_$key") ? 'selected' : '' ?>><?php echo $option; ?></option>
                          <?php endforeach; ?>
                        </select>
                      <?php else : ?>
                        <input type="text" style="width: 100%;" name="tpl_<?php echo $key; ?>" value="<?php echo get_option("tpl_$key"); ?>">
                      <?php endif; ?>
                    </td>
                  </tr>
                <?php endif; ?>
              <?php endforeach; ?>
            </tbody>
        </table>
        <div style="text-align: right; padding: 10px;">
          <input type="submit" value="Aggiorna impostazioni" class="button-primary" name="Submit">
        </div>
      </form>

    </div>

  <?php endif; ?>

  <?php if (current_user_can('administrator')) : ?>

    <div class="card" style="max-width: 100%;">
      <h2>Guida</h2>
      <p>
      I settaggi permettono di definire e accedere facilmente a impostazioni globali del template.
      Le impostazioni, una volta configurate, possono essere lette in qualsiasi punto del template e del backoffice atraverso l'uso della funzione <i>get_option()</i> di Wordpress.
      </p>

      <h4>Utilizzo</h4>
      <p>Iserire la configurazione delle impostazioni:</p>
      <div>
      <pre>
function wideo_tpl_initialize() {
  return array(
    'setting_key' => array(
      'label' => 'Setting label'
    ),
    'setting_key_2' => array(
      'label' => 'Setting label',
      'only_admin' => true,
      'type' => 'select',
      'select_options' => ['option1', 'option2', 'option3']
    )
  );
}
      </pre>
      </div>
      <br>
      <p>Ottenere il valore di una impostazione:</p>
      <div>
      <pre>
echo get_option('tpl_setting_key');
      </pre>
      </div>
    </div>

  <?php endif; ?>

</div>