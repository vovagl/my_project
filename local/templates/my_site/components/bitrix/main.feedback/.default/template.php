<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] === "POST" && check_bitrix_sessid()) {
    CModule::IncludeModule("iblock");

    $el = new CIBlockElement;

    $el->Add([
        "IBLOCK_ID" => 3, 
        "NAME" => $_POST["user_name"],
        "ACTIVE" => "Y",
        "PROPERTY_VALUES" => [
            "EMAIL" => $_POST["user_email"],
            "MESSAGE" => $_POST["MESSAGE"]
        ]
    ]);
    $_SESSION["FORM_SUCCESS"] = true;
    LocalRedirect($APPLICATION->GetCurPage());
    die();
}
$success = false;

if (!empty($_SESSION["FORM_SUCCESS"])) {
    $success = true;
    unset($_SESSION["FORM_SUCCESS"]);

}
?>
<?php if ($success): ?>
    <div  id="success" style="color:green; font-weight:bold; text-align:center;">
        ✔ Отправлено
    </div>
<?php endif; ?>

<form method="post">
    <?=bitrix_sessid_post()?>
    <input type="text" name="user_name" placeholder="Имя">
    <input type="email" name="user_email" placeholder="Email">
    <textarea name="MESSAGE" placeholder="Сообщение"></textarea>
    <button type="submit">Отправить</button>
</form>


<script>
document.addEventListener("DOMContentLoaded", function () {
    const msg = document.getElementById("success");
    if (msg) {
        setTimeout(() => {
            msg.style.transition = "opacity 0.5s";
            msg.style.opacity = "0";
            setTimeout(() => {
                msg.remove();
            }, 500);
        }, 4000);
    }
});
</script>
