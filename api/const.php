<?php

$statusOptions = [
    0 => "قيد الدراسة",
    1 => "تم التحقق",
    2 => "مرفوض",
    3 => "تم الطعن على الرفض"
];
$statusOptionsImages = [
    0 => "",
    1 => "styles/checked.png",
    2 => "styles/close.png",
    3 => "styles/report.png"
];

$handicap_type = [
    // "physical" => "إعاقة جسدية",
    "intellectual_disability" => "إعاقة ذهنية",
    "hearing_impairment" => "إعاقة سمعية",
    "visual_impairment" => "إعاقة بصرية",
    "motor_disability" => "إعاقة حركية"
];

$handicap_helps = [
    "intellectual_disability" => [
        "intellectual1" => "مراكز متخصصة للتكفل",
        "intellectual2" => "برامج تعليم وتأهيل",
        "intellectual3" => "متابعة نفسية واجتماعية �"
    ],
    "hearing_impairment" => [
        "hearing1" => "أجهزة سمع",
        "hearing2" => "متابعة طبية وتربوية",
        "hearing3" => "توجيه لمراكز مختصة",
    ],
    "visual_impairment" => [
        "visual1" => "نظارات طبية",
        "visual2" => "وسائل تعليم خاصة (برايل، لوحات)",
        "visual3" => "توجيه لمدارس ومراكز خاصة",
    ],
    "motor_disability" => [
        "motor1" => "كراسي متحركة (عادية أو كهربائية)",
        "motor2" => "عكازات",
        "motor3" => "أجهزة تعويضية",
        "motor4" => " دراجات ثلاثية العجلات �"
    ]
];
?>