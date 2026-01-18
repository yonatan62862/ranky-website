jQuery(function ($) {
    $("#contactCardForm").on("submit", function (e) {
        e.preventDefault();

        const form = $(this);

        $.ajax({
            url: contactFormData.ajaxUrl,
            method: "POST",
            data: {
                action: "submit_contact_card",
                formData: form.serialize(),
            },
            beforeSend() {
                form.addClass("is-loading");
            },
            success(res) {
                if (res.success) {
                    form.replaceWith(
                        '<p class="contact-card__success">Thank you, we’ll be in touch.</p>'
                    );
                } else {
                    alert(res.data || "Something went wrong");
                }
            },
            error() {
                alert("Server error");
            },
            complete() {
                form.removeClass("is-loading");
            },
        });
    });
});
