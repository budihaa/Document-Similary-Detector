$(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $(".modal-create").on("click", function () {
        $.ajax({
            type: "GET",
            url: $(this).attr("data-url"),
            success: function (response) {
                $(".modal-content").html(response);
                $(".modal-title").text("Tambah Kategori");
                $(".modal").modal("show");
            },
        });
    });

    // Edit form
    $("#datatable").on("click", ".edit", function () {
        $.ajax({
            type: "GET",
            url: $(this).attr("data-url"),
            success: function (response) {
                $(".modal-content").html(response);
                $("#modal").modal("show");
            },
        });
    });

    // Submitting form via AJAX
    $(".modal-content").on("click", "#btn-submit", function () {
        const form = $(".modal-content form"),
            url = form.attr("action"),
            type = $("input[name=_method]").val();

        // Remove validation error message
        form.find(".invalid-feedback").remove();
        form.find(".form-group").removeClass("is-invalid");

        $.ajax({ type: type, url: url, data: form.serialize() })
            .done(function () {
                $("#modal").modal("hide");

                $("#datatable").DataTable().ajax.reload();

                Swal({
                    position: "top-end",
                    type: "success",
                    title: "Data berhasil disimpan!",
                    showConfirmButton: false,
                    timer: 1500,
                });
            })
            .fail(function (error) {
                const res = error.responseJSON;
                if ($.isEmptyObject(res) === false) {
                    $.each(res.errors, function (key, value) {
                        $("#" + key)
                            .addClass("is-invalid")
                            .after(
                                `<div class="invalid-feedback">${value}</div>`
                            );
                    });
                }
            });
    });

    $("#datatable").on("click", ".delete", function () {
        swal({
            title: "Apakah anda yakin?",
            text: "Data ini akan terhapus.",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, saya yakin!",
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "POST",
                    url: $(this).attr("data-url"),
                    data: { _method: "DELETE" },
                })
                    .done(function (data) {
                        console.log(data);

                        $("#datatable").DataTable().ajax.reload();

                        swal({
                            type: "success",
                            title: "Sukses!",
                            text: "Data telah dihapus!",
                        });
                    })
                    .fail(function (xhr) {
                        swal({
                            type: "error",
                            title: "Oops...",
                            text: "Terjadi kesalahan, coba beberapa saat lagi.!",
                            footer: xhr.status + ": " + xhr.statusText,
                        });
                    });
            }
        });
    });
});
