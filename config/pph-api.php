<?php
return [
    "base_url"     => "https://api.pph.sh",
    "alternative"  => [
        "main"   => "https://api.pph.sh",
        "fsn-01" => "https://fsn-01.api.pph.sh",
        "nbg-01" => "https://nbg-01.api.pph.sh",
    ],
    "api_key"      => env("PPH_API_KEY", ""),
    "internal_key" => env("PPH_INTERNAL_API_KEY", ""),
];
