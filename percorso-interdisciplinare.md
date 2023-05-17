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

![[media/output.gif]]
```php
<? foreach ($sections as $section): ?>
    <?
	    $id = $section[0];
	    $heading = $section[1];
	    $paragraph = $section[2];
	    $image_src = $section[3];
    ?>
    <section id="<? echo "section-" . $id ?>"
        class="w-1/2 m-auto block bg-white hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
        <header id="<? echo "header-" . $id ?>" class="p-10 flex justify-between content-center">
            <h1 id="<? echo "h-" . $id ?>" class="pl-5 flex flex-col justify-between content-center">
                <? echo $heading ?>
            </h1>
            <div id="<? echo "options-" . $id ?>">
                <select id="<? echo "select-languages-" . $id ?>" name="<? echo "select-" . $id ?>">
                    <option value="it">IT</option>
                    <option value="en">EN</option>
                </select>
                <button id="<? echo "toggle-language-button-" . $id ?>"
                    class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                    X
                </button>
            </div>
        </header>
        <main id="<? echo "main-" . $id ?>" class="p-5 bg-black">
            <p id="<? echo "p-" . $id ?>" class="p-5 font-normal text-gray-700 dark:text-white"><? echo $paragraph; ?>
            </p>
            <img src="<? echo $image_src; ?>" />
        </main>
    </section>
<? endforeach; ?>
```

La componente grafica presenta tre elementi: l'intestazione `h1`, il dropdown menu per la scelta della lingua `ul` e il bottone per nascondere o mostrare la sezione `button`

Il linguaggio della sezione viene aggiornato selezionando il campo desiderato dal menu delle lingue:
```php
<select id="<? echo "select-languages-" . $id ?>" name="<? echo "select-" . $id ?>">
	<option value="it">IT</option>
	<option value="en">EN</option>
</select>
```

```js
 const toggleLanguageSelections = document.querySelectorAll("select");
    for (toggleLanguageSelection of toggleLanguageSelections) {
        toggleLanguageSelection.addEventListener("change", () => {
            const _sectionId = getSectionId(toggleLanguageSelection.id);
            const _language = toggleLanguageSelection.value;

            const h = document.getElementById("h-" + _sectionId);
            const p = document.getElementById("p-" + _sectionId);

            const data = { id: _sectionId, language: _language };
            const url = 'http://localhost/percorso-interdisciplinare-refactor/src/action.php';

            init = {
                method: 'POST',
                body: JSON.stringify(data),
                headers: {
                    'Content-type': 'application/json; charset=UTF-8',
                }
            };

            fetch(url, init).then((response) => response.json())
                .then(json => {
                    h.innerHTML = json.heading;
                    p.innerHTML = json.paragraph;
                }).catch(error => console.log(error));
        });
    }
```

```php
<?php
header('Content-Type: application/json');

$content = file_get_contents('php://input');
$json = json_decode($content, true);

include_once './database/connection.php';
$result = get_section($json['id'], $json['language']);

exit(json_encode($result));
```

```php
<?php
include_once __DIR__ . '/connection.php';
include_once __DIR__ . '/../configuration.php';

$CRAETE_DATABASE_QUERY = "CREATE DATABASE IF NOT EXISTS " . $DB_NAME;

$CREATE_TABLE_SECTION_QUERY = 'CREATE TABLE IF NOT EXISTS `sections_%s` (
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `image_id` int(11) unsigned NOT NULL,
    `heading` VARCHAR(255) NOT NULL,
    `paragraph` VARCHAR(255) NOT NULL,
    FOREIGN KEY (`image_id`) REFERENCES images(`id`)
)';

$CREATE_TABLE_IMAGE_QUERY = 'CREATE TABLE IF NOT EXISTS `images` (
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `src` VARCHAR(255) NOT NULL
)';

$INSERT_SECTIONS_QUERY = "INSERT INTO sections_%s ('image_id', 'heading', 'paragraph') VALUES ('%s', '%s', '%s')";
$INSERT_IMAGES_QUERY = "INSERT INTO images ('src') VALUES ('%s')";

$SELECT_SECTION_QUERY = "SELECT sections_%s.id, sections_%s.heading, sections_%s.paragraph, images.src FROM sections_%s, images WHERE sections_%s.image_id = images.id AND sections_%s.id = %s";
$SELECT_ALL_SECTIONS_QUERY = "SELECT sections_%s.id, sections_%s.heading, sections_%s.paragraph, images.src FROM sections_%s, images WHERE sections_%s.image_id = images.id";

$SELECT_IMAGES_QUERY = "SELECT * FROM images WHERE id = %s";
```