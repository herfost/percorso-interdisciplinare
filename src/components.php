<?php

function SectionHeader($id, $heading) {
    $headerStyle = "p-10 flex justify-between content-center";
    $h1Style =  "mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white";
    $buttonStyle = "p-5 bg-black";

    $headerHTMLComponent = '
    <header id="header-'. $id . '" class="'.$headerStyle . '">
    <h1 class="'.$h1Style . '">'.$heading . '</h1>
    <div id="options-'.$id '">
      <select id="select-languages-'.$id . '">
        <option value="it">IT</option>
        <option value="en">EN</option>
      </select>

      <button id="toggle-language-button-'.$id . '" class="'.$buttonStyle . '">
        <object
          id="object-'.$id . '"
          data="./assets/hide.svg"
          width="20"
          height="20"
        ></object>
      </button>
    </div>
    </header>
    ';

    return $headerHTMLComponent;
}

function SectionMain($id, $paragraphs) {
    $mainStyle = "pl-10 flex justify-between content-center";
    $pStyle = "font-normal text-gray-700 dark:text-white";

    $mainHTMLComponent = '<main id="main-'.$id .'" class="'.$mainStyle . '">';

    for ($paragraphs as $paragraph) $mainHTMLComponent .= '<p class="'.$pStyle . '">'.$paragraph .'</p>';

    $mainHTMLComponent .= '</main>';
    return $mainHTMLComponent;
}

function Section($id, $header, $paragraphs) {
    $sectionStyle = "w-1/2 m-auto block bg-white hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700";
    $SectionHTMLComponent = '<section id="section-'.$id . '">';
    $SectionHTMLComponent .= SectionHeader($id, $heading);
    $SectionHTMLComponent .= SectionMain($id, $paragraphs);
    $SectionHTMLComponent .= '</section>';

    return $SectionHTMLComponent;
}