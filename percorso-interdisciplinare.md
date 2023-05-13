---
tag: magistri-note
date: 2023-05-08
---

# Percorso interdisciplinare: IBM

Migrazione della ricerca sull'IBM

## Sezione

Ogni argomento esposto viene trascritto come sezione ossia una componente grafica contiene logica di funzionamento. L'utente interagisce con apposita IU.

![[../../_attachments/excalidraw/section]]

### Intestazione

![[../../_attachments/excalidraw/section-heading|section-heading]]

![showcase](/media/output.gif)

```html
<section
  id=<? echo "section-".$id ?>
  class="<? echo $sectionStyle ?>"
>
  <header
    id=<? echo "header-".$id ?>
    class="<? echo $headerStyle ?>"
  >
  <h1
    class="<? echo $h1Style ?>"
  ><? echo $heading ?></h1>
    <div id=<? echo "options-".$id ?>>
      <select
        id=<? echo "select-languages-".$id ?>
        name=<? echo "select-".$id ?>
      >
        <option value="it">IT</option>
        <option value="en">EN</option>
      </select>
      <button
        id=<? echo "toggle-language-button-".$id ?>
        class="<? echo $buttonStyle ?>"
      >
        <object
          id=<? echo "object-".$id; ?>
          data="<? echo $hideSectionSVG ?>"
          width="20"
          height="20"
        ></object>
      </button>
    </div>
  </header>
  <main
    id=<? echo "main-".$id ?>
    class="<? echo $mainStyle ?>"
  >
  <?php for($i = 0; $i < count($paragraphs); ++$i): ?>
    <p
      id=<? echo "p-".$i."-".$id?>
      class="<?echo $pStyle ?>"
    ><? echo $paragraphs[$i] ?></p>
  <?php endfor; ?>
  </main>
</section>
```

La componente grafica presenta tre elementi: l'intestazione `h1`, il dropdown menu per la scelta della lingua `ul` e il bottone per nascondere o mostrare la sezione `button`

Il linguaggio della sezione viene aggiornato selezionando il campo desiderato dal menu delle lingue:

```js
const toggleVisibilityButtons = document.querySelectorAll("button");
const toggleLanguageSelections = document.querySelectorAll("select");

for (toggleVisibilityButton of toggleVisibilityButtons) {
  toggleVisibilityButton.addEventListener("click", () => {
    const sectionId = getSectionId(toggleVisibilityButton.id);
    const main = document.getElementById("main-" + sectionId);
    const object = document.getElementById("object-" + sectionId);

    // hideSection
  });
}

for (toggleLanguageSelection of toggleLanguageSelections) {
  toggleLanguageSelection.addEventListener("change", () => {
    const sectionId = getSectionId(toggleLanguageSelection.id);
    const language = toggleLanguageSelection.value;
    const p = document.getElementById("p-" + sectionId + "-0");

    // Chiamata AJAX
  });
}
```

## Note
Da rivedere la struttura del database

```php
$QUERY_CREATE_TABLE_SECTION = 'CREATE TALBE IF NOT EXISTS `section_%s` (
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `heading` VARCHAR(255) NOT NULL
)';

$QUERY_CREATE_TABLE_PARAGRAPH = 'CREATE TALBE IF NOT EXISTS `paragraph_%s` (
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `section_id` int(11) unsigned NOT NULL,
    `content` VARCHAR(255) NOT NULL,
    `section_id` FOREIGN KEY (section_id) REFERENCES section_%s(id)
)';

$QUERY_CREATE_TABLE_IMAGE = 'CREATE TALBE IF NOT EXISTS `image` (
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `section_id` int(11) unsigned NOT NULL,
    `section_id` FOREIGN KEY (section_id) REFERENCES section_%s(id)
)';

$QUERY_SELECT_SECTIONS = 'SELECT * FROM `section_%s`';
$QUERY_SELECT_SECTION = 'SELECT * FROM `section_%s` s WHERE `s.section_id` = %d';

$QUERY_SELECT_PARAGRAPHS_BY_SECTION_ID = 'SELECT * FROM `paragraph_%s` p WHERE `p.section_id` = %d';

sprintf($QUERY_CREATE_TABLE_SECTION, 'it');
sprintf($QUERY_CREATE_TABLE_SECTION, 'en');
sprintf($QUERY_CREATE_TABLE_PARAGRAPH, 'it', 'it');
sprintf($QUERY_CREATE_TABLE_PARAGRAPH, 'en', 'en');
sprintf($QUERY_CREATE_TABLE_IMAGE, 'it');
```
