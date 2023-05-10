<?php

function SectionHeader($section_id, $html_classes, $heading) {
    $header_html = '
    <header id="header-%s" class="%s">
        <h1>%s</h1>
        <div id="options-%s" class="options">
            <select name="language" id="languages">
                <option value="it"><svg .../></option> <!-- svg = bandiera lingua -->
                <option value="en"><svg .../></option>
            </select> 
            <button id="toggle-language-button-%s><svg id="toggle-icon-%s".../></button> <!-- toggle nasconi / mostra, svg = toggle icon -->
        </div>
    </header>
    ';

    return sprintf($header_html, $section_id, $html_classes, $heading, $section_id, $section_id, $section_id);
}

?>

<script>
    const heading = getElementById('heading-0');
    const toggleLanguageButton = getElementById('toggle-language-button-0');
</script>