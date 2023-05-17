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

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script>
    // Utility
    function getSectionId(elementId) {
        const lastIndex = elementId.lastIndexOf("-");
        return elementId.slice(lastIndex + 1);
    }

    // Toggle Main Visibility
    const toggleVisibilityButtons = document.querySelectorAll("button");

    for (toggleVisibilityButton of toggleVisibilityButtons) {
        toggleVisibilityButton.addEventListener("click", () => {
            const sectionId = getSectionId(toggleVisibilityButton.id);
            const main = document.getElementById("main-" + sectionId);

            const changes = (main.style.display == "none") ? ['block', 'X'] : ['none', 'V'];

            main.style.display = changes[0];
            toggleVisibilityButton.innerHTML = changes[1];
        });
    }

    // Toggle Language
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
</script>