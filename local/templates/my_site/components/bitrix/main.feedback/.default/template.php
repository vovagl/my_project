<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Связаться");

CModule::IncludeModule("iblock");
$success = ($_GET["success"] ?? "") === "Y";

if ($_SERVER["REQUEST_METHOD"] === "POST" && check_bitrix_sessid()) {

    $el = new CIBlockElement;

    $PROP = array(
        "COMPANY" => $_POST["medicine_company"],
        "EMAIL" => $_POST["medicine_email"],
        "PHONE" => $_POST["medicine_phone"],
        "MESSAGE" => $_POST["medicine_message"],
    );

    $arLoadProductArray = array(
        "IBLOCK_ID" => 3, 
        "NAME" => trim($_POST["medicine_name"]),
        "ACTIVE" => "Y",
        "PROPERTY_VALUES" => $PROP,
    );
    LocalRedirect($APPLICATION->GetCurPageParam("success=Y", ["success"]));
    die();
}
?>


<div class="contact-form">
    <div class="contact-form__head">
        <div class="contact-form__head-title">Связаться</div>
        <div class="contact-form__head-text">
            Наши сотрудники помогут выполнить подбор услуги и расчет цены с учетом ваших требований
        </div>
    </div>
      
     <div  id="success" class=" <?= $success ? 'show' : '' ?>"> 
        ✔ Отправлено
    </div> 
    <form novalidate class="contact-form__form" action="<?=POST_FORM_ACTION_URI?>" method="POST">

        <?= bitrix_sessid_post() ?>

        <div class="contact-form__form-inputs">

            <div class="input contact-form__input">
                <label class="input__label" for="medicine_name">
                    <div class="input__label-text">Ваше имя*</div>
                    <input class="input__input" type="text" id="medicine_name" name="medicine_name" value="" required="">
                    <div class="input__notification">Поле должно содержать не менее 3-х символов</div>
                </label>
            </div>

            <div class="input contact-form__input">
                <label class="input__label" for="medicine_company">
                    <div class="input__label-text">Компания/Должность*</div>
                    <input class="input__input" type="text"  id="medicine_company" name="medicine_company" value="" required="">
                    <div class="input__notification">Поле должно содержать не менее 3-х символов</div>
                </label>
            </div>

            <div class="input contact-form__input">
                <label class="input__label" for="medicine_email">
                    <div class="input__label-text">Email*</div>
                    <input class="input__input" type="email" id="medicine_email" name="medicine_email" value="" required="">
                    <div class="input__notification">Неверный формат почты</div>
                </label>
            </div>

            <div class="input contact-form__input">
                <label class="input__label" for="medicine_phone">
                    <div class="input__label-text">Номер телефона*</div>
                    <input class="input__input" type="tel" id="medicine_phone" data-inputmask="'mask': '+79999999999', 'clearIncomplete': 'true'" maxlength="12"
                    x-autocompletetype="phone-full" name="medicine_phone" value="" required="">
                    <div class="input__notification">Правильно: +7XXXXXXXXXX</div>
                </label>
            </div>

        </div>

        <div class="contact-form__form-message">
            <div class="input">
                <label class="input__label" for="medicine_message">
                    <div class="input__label-text">Сообщение</div>
                    <textarea class="input__input" type="text" id="medicine_message" name="medicine_message" value=""></textarea>
                    <div class="input__notification">Напишите сообщение</div>
                </label>
            </div>
        </div>

        <div class="contact-form__bottom">
            <div class="contact-form__bottom-policy">
                Нажимая «Отправить», вы подтверждаете, что ознакомлены,  полностью согласны и принимаете условия Согласия на обработку персональных данных.
            </div>

            <button class="form-button contact-form__bottom-button" data-success="Отправлено" data-error="Ошибка отправки" type="submit">
                <div class="form-button__title">Отправить</div>
            </button>
        </div>

    </form>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const msg = document.getElementById("success");
    if (msg) {
        setTimeout(() => {
            msg.classList.remove("show");
            }, 3000);
        }
     if (window.location.search.includes("success=Y")) {
        const url = new URL(window.location);
        url.searchParams.delete("success");
        window.history.replaceState({}, document.title, url.pathname);
    }        
});
</script>

<script>
document.addEventListener("DOMContentLoaded", function () {

    const form = document.querySelector(".contact-form__form");
    const inputs = document.querySelectorAll(".input__input");

    function validateField(input)  {
        const wrapper = input.closest(".input");
        let isValid = true;

        if (input.value.trim().length < 3) {
            isValid = false;
        }
         if 
            (input.id === "medicine_message") 
        {
           isValid = input.value.trim().length >= 1;
        }
        if (input.type === "email") {
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(input.value.trim())) {
                isValid = false;
            }
        }
        if (input.type === "tel") {
            const phone = input.value.replace(/\D/g, "");
            if (phone.length < 11) {
                isValid = false;
            }
        }
          wrapper.classList.toggle("error", !isValid);
           return isValid;
        }
       form.addEventListener("submit", function (e) {

        let allValid = true;

        inputs.forEach(input => {
            const ok = validateField(input);
            if (!ok) allValid = false;
        });

        if (!allValid) {
            e.preventDefault(); 
        }
    });
    })
</script>