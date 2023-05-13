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

```html
<header id="header-%s" class="%s">
	<h1>%s</h1>
	<div id="options-%s" class="options">
		<select name="language" id="languages">
			<option value="it"><svg ...></svg></option> <!-- svg = bandiera lingua -->
			<option value="en"><svg ...></svg></option>
		</select>
		<button id="toggle-language-button-%s"><svg id="toggle-icon-%s"></svg></button> <!-- toggle nasconi / mostra, svg = toggle icon -->
	</div>
</header>
```

La componente grafica presenta tre elementi: l'intestazione `h1`, il dropdown menu per la scelta della lingua `ul` e il bottone per nascondere o mostrare la sezione `button`

Il linguaggio della sezione viene aggiornato selezionando il campo desiderato dal menu delle lingue:

```js
ul.addEventListener(onChoice, changeLanguage);

changeLanguage = (section_id, language) => {
  const sectionAPI = "...";
  const heading = document.getElementById("heading-" + section_id);
  const content = document.getElementById("content-" + section_id);

  fetch(sectionAPI + language)
    .then((response) => {
      response.json;
    })
    .then((json) => {
      heading.innerHTML = json.heading;
      content.innerHTML = json.content;
    });
};
```

## Note

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
