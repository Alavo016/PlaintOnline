<!DOCTYPE html>
<!--[if IE 8 ]><html class="ie" xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<!--<![endif]-->

<head>
    <!-- Basic Page Needs -->
    <meta charset="utf-8">
    <!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
    <title>Remos eCommerce Admin Dashboard HTML Template</title>

    <meta name="author" content="themesflat.com">

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Theme Style -->
    <link rel="stylesheet" type="text/css" href="css/animate.min.css">
    <link rel="stylesheet" type="text/css" href="css/animation.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap-select.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">



    <!-- Font -->
    <link rel="stylesheet" href="font/fonts.css">

    <!-- Icon -->
    <link rel="stylesheet" href="icon/style.css">

    <!-- Favicon and Touch Icons  -->
    <link rel="shortcut icon" href="images/favicon.png">
    <link rel="apple-touch-icon-precomposed" href="images/favicon.png">
    <style>
        /* Augmenter la taille de la table sur PC */
        .table-container {
            max-width: 90%;
            margin: auto;
        }

        table {
            font-size: 1.1rem;
            /* Texte plus grand */
        }

        th,
        td {
            padding: 10px !important;
        }

        /* Agrandir les boutons */


        /* Assurer une bonne responsivité */
        @media (max-width: 768px) {
            .table-container {
                max-width: 100%;
            }

            table {
                font-size: 0.9rem;
            }

            .btn {
                font-size: 0.8rem;
                padding: 8px 10px;
            }
        }

        .uploadfile {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 150px;
            border: 2px dashed #007bff;
            border-radius: 10px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease-in-out;
            background-color: #f8f9fa;
            position: relative;
        }

        .uploadfile:hover {
            background-color: #e9ecef;
        }

        .uploadfile .icon {
            font-size: 40px;
            color: #007bff;
            margin-bottom: 10px;
        }

        .uploadfile input[type="file"] {
            display: none;
        }

        .upload-preview {
            display: flex;
            margin-top: 10px;
            gap: 10px;
        }

        .upload-preview img {
            max-width: 80px;
            height: 80px;
            border-radius: 5px;
            object-fit: cover;
            border: 1px solid #ccc;
        }

        .upload-preview .file-info {
            display: flex;
            flex-direction: column;
            font-size: 14px;
        }
    </style>

</head>

<body class="body">

    <!-- #wrapper -->
    <div id="wrapper">
        <!-- #page -->
        <div id="page" class="">
            <!-- layout-wrap -->
            <div class="layout-wrap">