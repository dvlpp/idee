<?php

return [
    "name" => "IDeE",
    "auth_service" => false,

    "cms" => [
        "contenu" => [
            "label" => "Contenu",
            "entities" => [
                "projet" => [

                    "label"   => "projet",
                    "icon"    => "glass",
                    "plural"  => "projets",

                    "active_state_field" => "contenu~en_ligne",

                    "duplicable" => true,

                    "list_template" => [

                        "columns" => [
                            "visuel" => [
                                "header"   => "",
                                "renderer" => '\Idee\Sharp\ColumnsRenderers\ProjetVisuel',
                                "width" => 2
                            ],
                            "titre" => [
                                "header"   => "Titre",
                                "renderer" => '\Idee\Sharp\ColumnsRenderers\ContenuTitre',
                                "width" => 8
                            ],
                        ],

                        "paginate" => false,

                        "reorderable" => true,

                        "searchable" => true

                    ],

                    // Model
                    "repository" => '\Idee\Sharp\ProjetRepository',
                    "validator" => '\Idee\Sharp\ProjetValidator',

                    // Fields
                    "form_fields" => [

                        "contenu~titre" => [
                            "label" => "Titre",
                            "type" => "text",
                        ],

                        "contenu~chapo" => [
                            "label" => "Chapo",
                            "type" => "markdown",
                            "toolbar" => true,
                            "height" => 180
                        ],

                        "contenu~texte" => [
                            "label" => "Texte de description",
                            "type" => "markdown",
                            "toolbar" => true,
                            "height" => 300
                        ],

                        "is_mode_actu" => [
                            "type" => "check",
                            "text" => "Mode actualité"
                        ],

                        "texte_actu" => [
                            "label" => "Texte de l'actualité",
                            "type" => "textarea",
                            "height" => 200,
                            "conditional_display" => "is_mode_actu"
                        ],

                        "couleur" => [
                            "label" => "Couleur principale (fond, liens)",
                            "type" => "text",
                            "attributes" => [
                                "placeholder" => "ff0000"
                            ]
                        ],

                        "visuel" => [
                            "label" => "Photo principale",
                            "type" => "file",
                            "file_filter" => "jpg,jpeg",
                            "file_filter_alert" => "Image au format JPG seulement",
                            "thumbnail" => "0x100",
                            "conditional_display" => "!is_mode_actu"
                        ],

                        "visuels" => [
                            "label" => "Visuels",
                            "type" => "list",
                            "sortable" => true,
                            "addable" => true,
                            "removable" => true,
                            "order_attribute" => "ordre",
                            "add_button_text" => "Ajouter un visuel",
                            "remove_btn_text" => "Supprimer",
                            "item" => [
                                "photo" => [
                                    "type" => "file",
                                    "file_filter" => "jpg,jpeg",
                                    "file_filter_alert" => "Image au format JPG seulement",
                                    "thumbnail" => "0x100",
                                ],
                                "legende" => [
                                    "type" => "text",
                                    "attributes" => [
                                        "placeholder" => "Légende"
                                    ]
                                ],
                            ]
                        ],
//                        "dossier" => [
//                            "label" => "Dossier",
//                            "type" => "file",
//                            "file_filter" => "pdf,zip",
//                            "file_filter_alert" => "PDF ou ZIP"
//                        ],

                        "fichiers" => [
                            "label" => "Fichiers à télécharger",
                            "type" => "list",
                            "sortable" => true,
                            "addable" => true,
                            "removable" => true,
                            "order_attribute" => "ordre",
                            "add_button_text" => "Ajouter un fichier",
                            "remove_btn_text" => "Supprimer",
                            "item" => [
                                "fichier" => [
                                    "type" => "file",
                                    "file_filter" => "pdf,zip",
                                    "file_filter_alert" => "PDF et ZIP seulement"
                                ],
                                "titre" => [
                                    "type" => "text",
                                    "attributes" => [
                                        "placeholder" => "Titre du fichier"
                                    ]
                                ],
                            ]
                        ],

                        "partenaires" => [
                            "label" => "Partenaires",
                            "type" => "list",
                            "sortable" => true,
                            "addable" => true,
                            "removable" => true,
                            "order_attribute" => "ordre",
                            "add_button_text" => "Ajouter un partenaire",
                            "remove_btn_text" => "Supprimer",
                            "item" => [
                                "nom" => [
                                    "type" => "text",
                                    "attributes" => [
                                        "placeholder" => "Nom"
                                    ]
                                ],
                                "url" => [
                                    "type" => "text",
                                    "attributes" => [
                                        "placeholder" => "http://"
                                    ]
                                ],
                            ]
                        ],
                    ],

                    "form_layout" => [
                        "tab1" => [
                            "tab" => "Projet",
                            "col1" => [
                                "contenu~titre",
                                "contenu~chapo",
                                "couleur",
                                "is_mode_actu",
                                "texte_actu",
                                "visuel",
                                "contenu~texte",
                            ],
                            "col2" => [
                                "visuels",
                                "fichiers",
                                "partenaires"
                            ]
                        ],
                    ]
                ],


                "page" => [

                    "label"   => "page",
                    "icon"    => "file-o",
                    "plural"  => "pages",

                    "active_state_field" => "contenu~en_ligne",

                    "duplicable" => true,

                    "list_template" => [

                        "columns" => [
                            "key" => [
                                "header"   => "",
                                "width" => 2
                            ],
                            "titre" => [
                                "header"   => "Titre",
                                "renderer" => '\Idee\Sharp\ColumnsRenderers\ContenuTitre',
                                "width" => 6
                            ],
                        ],

                        "paginate" => false,

                        "reorderable" => true

                    ],

                    // Model
                    "repository" => '\Idee\Sharp\PageRepository',
                    "validator" => '\Idee\Sharp\PageValidator',

                    // Fields
                    "form_fields" => [
                        "key" => [
                            "label" => "Adresse",
                            "type" => "text",
                            "help" => "Mot unique servant à l'URL de la page. Pas d'accent, d'espace ou de caractère spécial."
                        ],

                        "contenu~titre" => [
                            "label" => "Titre",
                            "type" => "text",
                        ],

                        "contenu~chapo" => [
                            "label" => "Chapo",
                            "type" => "markdown",
                            "toolbar" => true,
                            "height" => 180
                        ],

                        "contenu~texte" => [
                            "label" => "Texte de description",
                            "type" => "markdown",
                            "toolbar" => true,
                            "height" => 300
                        ],

                        "texte2" => [
                            "label" => "Texte secondaire",
                            "type" => "markdown",
                            "toolbar" => true,
                            "height" => 200
                        ],
                    ],

                    "form_layout" => [
                        "tab1" => [
                            "tab" => "Page",
                            "col1" => [
                                "key",
                                "contenu~titre",
                                "contenu~chapo",
                            ],
                            "col2" => [
                                "contenu~texte",
                                "texte2"
                            ]
                        ],
                    ]
                ]
            ]
        ],
    ]
];