<html lang="en">
<head>
    <title>Eridian Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/dark.css">
    <style>
        :root {
            --background-body: #111;
            --background: #000;
            --background-alt: #222;
            --selection: #822;
            --text-main: #ddd;
            --text-bright: #fff;
            --text-muted: #aaa;
            --links: #41adff;
            --focus: #922;
            --border: #222;
            --code: #ddd;
            --animation-duration: 0.1s;
            --button-base: var(--background-alt);
            --button-hover: var(--background);
            --scrollbar-thumb: var(--button-hover);
            --scrollbar-thumb-hover: rgb(0, 0, 0);
            --form-placeholder: var(--text-muted);
            --form-text: var(--text-main);
            --variable: #d941e2;
            --highlight: #efdb43;
            --select-arrow: url("data:image/svg+xml;charset=utf-8,%3C?xml version='1.0' encoding='utf-8'?%3E %3Csvg version='1.1' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' height='62.5' width='116.9' fill='%23efefef'%3E %3Cpath d='M115.3,1.6 C113.7,0 111.1,0 109.5,1.6 L58.5,52.7 L7.4,1.6 C5.8,0 3.2,0 1.6,1.6 C0,3.2 0,5.8 1.6,7.4 L55.5,61.3 C56.3,62.1 57.3,62.5 58.4,62.5 C59.4,62.5 60.5,62.1 61.3,61.3 L115.2,7.4 C116.9,5.8 116.9,3.2 115.3,1.6Z'/%3E %3C/svg%3E");
        }

        body {
            margin: auto auto;
            min-height: 100vh;
        }
    </style>
</head>
<body>

<?php
session_start();
?>