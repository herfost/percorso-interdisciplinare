<?php 
$sectionStyle = "w-1/2 m-auto block bg-white hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700";
$headerStyle = "p-10 flex justify-between content-center";
$mainStyle = "pl-5 flex flex-col justify-between content-center";
$h1Style = "mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white";
$buttonStyle = "p-5 bg-black";
$pStyle = "p-5 font-normal text-gray-700 dark:text-white";

?> 
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
          data="./assets/hide.svg"
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

<script>
    // Variables
    const hideSectionSVG = "./assets/hide.svg";
    const showSectionSVG = "./assets/show.svg";

    // Toggle Main Visibility
    const toggleVisibilityButtons = document.querySelectorAll("button");

    for (toggleVisibilityButton of toggleVisibilityButtons) {
      toggleVisibilityButton.addEventListener("click", () => {
        const lastIndex = toggleVisibilityButton.id.lastIndexOf("-");
        const sectionId = toggleVisibilityButton.id.slice(lastIndex + 1);

        const main = document.getElementById("main-" + sectionId);
        const object = document.getElementById("object-" + sectionId);

        // TODO: aggiungere animazione
        if (main.style.display === "none") {
          style = "block";
          svg = hideSectionSVG;
        } else {
          style = "none";
          svg = showSectionSVG;
        }

        main.style.display = style;
        object.data = svg;
      });
    }

    // Toggle Language
    const toggleLanguageSelections = document.querySelectorAll("select");
    for (toggleLanguageSelection of toggleLanguageSelections) {
      toggleLanguageSelection.addEventListener("change", () => {
        const lastIndex = toggleLanguageSelection.id.lastIndexOf("-");
        const sectionId = toggleLanguageSelection.id.slice(lastIndex + 1);

        const language = toggleLanguageSelection.value;
        const p = document.getElementById("p-" + sectionId + "-0");

        // TODO: Chiamata AJAX
        p.innerHTML = language === "it" ? "Italiano" : "English";
      });
    }
  </script>