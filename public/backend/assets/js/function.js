function showDeleteConfirmation(callback) {
    Swal.fire({
        title: "Bạn có chắc không?",
        text: "Khi bạn đồng ý, bạn sẽ không thể quay lại!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Vâng, Xóa!",
    }).then((result) => {
        if (result.isConfirmed) {
            callback();
        }
    });
}

function alertError(message) {
    Lobibox.notify("error", {
        pauseDelayOnHover: true,
        size: "mini",
        rounded: true,
        delayIndicator: false,
        icon: "bx bx-x-circle",
        continueDelayOnInactiveTab: false,
        position: "top right",
        msg: message,
    });
}

function alertSuccess(message) {
    Lobibox.notify("success", {
        pauseDelayOnHover: true,
        size: "mini",
        rounded: true,
        icon: "bx bx-check-circle",
        delayIndicator: false,
        continueDelayOnInactiveTab: false,
        position: "top right",
        msg: message,
    });
}

function alertErrorAPI(errors) {
    let msg = "";
    if (!errors) {
        alertError("Đã có lỗi xẩy ra");
        return;
    }
    Object.keys(errors).forEach(function (key) {
        errors[key].forEach((element) => {
            msg += `<p class="mb-1">${element}</p>`;
        });
    });
    alertError(msg);
}

function convertDateVn(dateString) {
    if (!dateString) {
        return "";
    }
    const date = new Date(dateString);
    return (formattedDate = date.toLocaleDateString("en-GB"));
}
var loading = $("#preloader");

function resetPickadate() {
    $(".datepicker").each(function () {
        let min = $(this).attr("min") ? $(this).attr("min") : "";
        let max = $(this).attr("max") ? $(this).attr("max") : "";
        let config = {
            selectMonths: true,
            selectYears: true,
            icon: '<i class="fa fa-calendar"></i>',
            format: "dd/mm/yyyy",
        };

        let picker = $(this).pickadate(config).pickadate("picker");

        if (max) {
            picker.set("max", new Date(max));
        }

        if (min) {
            picker.set("min", new Date(min));
        }
    });
}

function applyDateRangePicker() {
    $(".date-range-picker").each(function () {
        let min = $(this).attr("min") ? $(this).attr("min") : "";
        let max = $(this).attr("max") ? $(this).attr("max") : "";
        let config = {
            autoUpdateInput: false,
            locale: {
                format: "DD/MM/YYYY",
                cancelLabel: "Clear",
            },
        };
        if (min) {
            config.minDate = new Date(min);
        }

        if (max) {
            config.maxDate = new Date(max);
        }
        //daterangepicker
        $(this).daterangepicker(config);
        $(this).on("apply.daterangepicker", function (ev, picker) {
            $(this).val(
                picker.startDate.format("DD/MM/YYYY") +
                    " - " +
                    picker.endDate.format("DD/MM/YYYY")
            );
        });

        $(this).on("cancel.daterangepicker", function (ev, picker) {
            $(this).val("");
        });
    });
}

function resetSelectAjax(type = null) {
    $(".select2-ajax-single").each(function () {
        var _this = $(this);
        var placeholder = _this.data("placeholder");
        var url = _this.data("url");
        var limit = obj_config.limit;
        var selected_id = _this.attr("data-selected-id");
        _this.select2({
            theme: "bootstrap4",
            placeholder: placeholder,
            allowClear: true,
            language: {
                inputTooShort: function () {
                    return "Vui lòng nhập ít nhất 1 ký tự";
                },
            },
            ajax: {
                url: url,
                dataType: "json",
                delay: 250,
                data: function (params) {
                    return {
                        q: params.term, // search term
                        page: params.page,
                        limit: limit,
                    };
                },
                processResults: function (data, params) {
                    params.page = params.page || 1;
                    params.limit = params.limit || 10;

                    var results = [];
                    data.datas.data.forEach(function (item) {
                        results.push({
                            id: item.id,
                            text: item.name,
                        });
                    });

                    return {
                        results: results,
                        pagination: {
                            more: params.page * params.limit < data.datas.total,
                        },
                    };
                },
                cache: true,
            },
            minimumInputLength: 1,
            templateResult: formatRepo,
            templateSelection: formatRepoSelection,
        });

        // Set the selected value after initializing select2
        if (selected_id) {
            $.ajax({
                type: "GET",
                url: url,
                data: { id: selected_id },
            }).then(function (data) {
                // Assuming data is an array of records
                data.datas.data.forEach(function (item) {
                    // Create the option and append to Select2
                    var option = new Option(item.name, item.id, true, true);
                    _this.append(option).trigger("change", {isAjax: false});
                });

                // Manually trigger the `select2:select` event for the first item
                if (data.datas.data.length > 0) {
                    _this.trigger({
                        type: "select2:select",
                        params: {
                            data: data[0],
                        },
                    });
                }
            });
        }
    });
}

function formatRepo(repo) {
    if (repo.loading) {
        return repo.text;
    }

    var $container = $(
        `<div class='select2-result-repository clearfix'>
            <div class='select2-result-repository__meta'>
                <div class='select2-result-repository__title'><strong>${repo.text}</strong></div>
            </div>
        </div>`
    );

    return $container;
}

function formatRepoSelection(repo) {
    return repo.text || repo.text;
}

function convertDateVnToEn(input) {
    if (!input) return "";
    var parts = input.split("/");
    var day = parts[0];
    var month = parts[1];
    var year = parts[2];
    var inputNew = year + "-" + month + "-" + day;
    return inputNew;
}

function caculatorDayByDate(input, number) {
    if (!input) return "";
    var parts = input.split("/");
    var day = parts[0];
    var month = parts[1];
    var year = parts[2];
    var inputNew = year + "-" + month + "-" + day;
    var date = new Date(inputNew);
    date.setDate(date.getDate() + number);
    var dateNew = date.toISOString().slice(0, 10);
    return convertDateVn(dateNew);
}

/**
 * Thumbnail
 */
function previewImage(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
            const container = document.querySelector(".thumbnail-container");
            container.style.backgroundImage = `url(${e.target.result})`;
            container.querySelector(".placeholder").style.display = "none";
            container.querySelector(".delete-btn").style.display = "block";
        };
        reader.readAsDataURL(file);
    }
}

function deleteImage(event) {
    event.stopPropagation();
    const container = document.querySelector(".thumbnail-container");
    container.style.backgroundImage = "none";
    container.querySelector(".placeholder").style.display = "block";
    container.querySelector(".delete-btn").style.display = "none";
    document.getElementById("fileInput").value = "";
}

$(function () {
    function initializeSelect2() {
        $(".single-select").each(function () {
            let _this = $(this);
            $(_this).select2({
                theme: "bootstrap4",
                placeholder: _this.data("placeholder") || "Chọn một tùy chọn",
                allowClear: Boolean(_this.data("allow-clear")),
            });
        });
    }

    initializeSelect2();

    function loadDataAjax(elReload = "", callback) {
        $(".load-data-ajax").each(function () {
            var $this = $(this);
            var data = "";
            var elId = $this.attr("id");
            if (elReload && elReload != `#${elId}`) return;

            var formSearch = $this.attr("data-search");
            if ($(formSearch).length) {
                data = $(formSearch).serialize();
            }

            var url = $this.data("url");
            $.ajax({
                url: url,
                method: "GET",
                data: data,
                success: function (response) {
                    $this.html(response);
                    if (typeof callback === "function") {
                        callback();
                    }
                },
                error: function (xhr) {
                    console.error("Error loading data:", xhr);
                    if (typeof callback === "function") {
                        callback();
                    }
                },
            });
        });
    }

    loadDataAjax();

    $(".form-search-submit").on("submit", function (e) {
        e.preventDefault();
        var $button = $(this).find('button[type="submit"]');
        var $spinner = $button.find(".spinner-border");
        var $elReload = $(this).attr("data-reload");

        // Hiển thị spinner và disabled button
        $spinner.show();
        $button.prop("disabled", true);

        loadDataAjax($elReload, function () {
            // Ẩn spinner và bỏ disabled button sau khi gọi AJAX xong
            $spinner.hide();
            $button.prop("disabled", false);
        });
    });

    $(document).on("click", ".pagination a", function (e) {
        e.preventDefault();
        var url = $(this).attr("href");
        var elReload = $(this).closest(".load-data-ajax").attr("data-reload");
        $(this).closest(".load-data-ajax").data("url", url);
        loadDataAjax(elReload);
    });

    $(document).on("submit", ".form-submit-ajax", function (e) {
        e.preventDefault();
        var $form = $(this);
        var url = $form.attr("action");
        var method = $form.attr("method");
        var data = $form.serialize();
        var elReload = $form.attr("data-reload");

        $.ajax({
            url: url,
            method: method,
            data: data,
            success: function (response) {
                if (response.success) {
                    Swal.fire({
                        icon: "success",
                        title: "Thành công",
                        text: response.success,
                        timer: 2000,
                        showConfirmButton: false,
                    });
                    $form[0].reset();
                    $form.closest(".modal").modal("hide");
                    if (elReload) loadDataAjax(elReload);
                }
            },
            error: function (xhr) {
                var errors = xhr.responseJSON.errors;
                var errorMessages = "";
                $.each(errors, function (key, value) {
                    errorMessages += "<li>" + value[0] + "</li>";
                });
                Swal.fire({
                    icon: "error",
                    title: "Lỗi",
                    html:
                        '<ul class="cs-errors alert alert-danger">' +
                        errorMessages +
                        "</ul>",
                    showConfirmButton: false,
                });
            },
        });
    });

    function removeAllModals() {
        $('.modal').each(function() {
            $(this).modal('hide'); // Ẩn modal
            $(this).remove(); // Xóa modal khỏi DOM
        });
    }

    $(document).on("click", ".btn-create-ajax", function (e) {
        e.preventDefault();
        removeAllModals();
        var elmModal = $(this).attr("data-cs-modal");
        var url = $(this).attr("href");
        $.ajax({
            url: url,
            method: "GET",
            success: function (response) {
                $(elmModal).remove();
                $("body").append(response);
                $(elmModal).modal("show");
                initializeSelect2();
                resetSelectAjax();
            },
            error: function (xhr) {
                console.error("Error loading create modal:", xhr);
            },
        });
    });

    $(document).on("click", ".btn-edit-ajax", function (e) {
        e.preventDefault();
        removeAllModals();
        var elmModal = $(this).attr("data-cs-modal");
        var url = $(this).attr("href");
        $.ajax({
            url: url,
            method: "GET",
            success: function (response) {
                $(elmModal).remove();
                $("body").append(response);
                $(elmModal).modal("show");
                initializeSelect2();
                resetSelectAjax();
            },
            error: function (xhr) {
                console.error("Error loading edit modal:", xhr);
            },
        });
    });

    $(document).on("submit", ".delete-form-ajax", function (e) {
        e.preventDefault();
        var $form = $(this);
        var url = $form.attr("action");
        var method = $form.attr("method");
        var data = $form.serialize();

        Swal.fire({
            title: "Bạn có chắc không?",
            text: "Khi bạn đồng ý, bạn sẽ không thể quay lại!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Vâng, Xóa!",
            cancelButtonText: "Hủy",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: url,
                    method: method,
                    data: data,
                    success: function (response) {
                        if (response.success) {
                            Swal.fire({
                                icon: "success",
                                title: "Xoá thành công",
                                text: response.success,
                                timer: 2000,
                                showConfirmButton: false,
                            });
                            loadDataAjax();
                        }
                    },
                    error: function (xhr) {
                        Swal.fire({
                            icon: "error",
                            title: "Lỗi",
                            text: "Không thể xóa.",
                            timer: 2000,
                            showConfirmButton: false,
                        });
                    },
                });
            }
        });
    });

    $(".delete-btn").on("click", function (event) {
        event.preventDefault();
        var form = $(this).closest("form");
        Swal.fire({
            title: "Bạn có chắc không?",
            text: "Khi bạn đồng ý, bạn sẽ không thể quay lại!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Vâng, Xóa!",
            cancelButtonText: "Hủy",
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });

    // Thay đổi học viên
    $("body").on("change", "#change-hoc-vien", function (e, extraData = {isAjax: true}) {
        var userId = $(this).val();
        if (userId && extraData.isAjax) {
            $.ajax({
                url: `/admin/users/${userId}/detail`,
                type: "GET",
                success: function (data) {
                    $("#name").val(data.name);
                    $("#email").val(data.email);
                    $("#phone").val(data.phone);
                    $("#address").val(data.address);
                    $("#description").val(data.description);
                    $("#dob").val(data.dob);
                },
                error: function () {
                    alert("Failed to fetch user details.");
                },
            });
        }
    });

    // old =============

    resetPickadate();
    resetSelectAjax();

    applyDateRangePicker();

    function resetMaxDate(_this) {
        let oestrous_day = _this
            .parents("form")
            .find('input[name="oestrous_day"]');
        let breeding_date_first = _this
            .parents("form")
            .find('input[name="breeding_date_first"]');
        let breeding_date_second = _this
            .parents("form")
            .find('input[name="breeding_date_second"]');
        let expected_pregnancy_day = _this
            .parents("form")
            .find('input[name="expected_pregnancy_day"]');
        let pregnancy_day = _this
            .parents("form")
            .find('input[name="pregnancy_day"]');
        let expected_birth_date = _this
            .parents("form")
            .find('input[name="expected_birth_date"]');

        let oestrous_day_val = convertDateVnToEn(oestrous_day.val());
        let breeding_date_first_val = convertDateVnToEn(
            breeding_date_first.val()
        );
        let breeding_date_second_val = convertDateVnToEn(
            breeding_date_second.val()
        );
        let expected_pregnancy_day_val = convertDateVnToEn(
            expected_pregnancy_day.val()
        );
        let expected_birth_date_val = convertDateVnToEn(
            expected_birth_date.val()
        );
        let pregnancy_day_val = convertDateVnToEn(pregnancy_day.val());

        if (oestrous_day_val) {
            breeding_date_first.attr("min", oestrous_day_val);
            breeding_date_second.attr("min", oestrous_day_val);
            expected_pregnancy_day.attr("min", oestrous_day_val);
            pregnancy_day.attr("min", oestrous_day_val);
            expected_birth_date.attr("min", oestrous_day_val);

            breeding_date_second.attr("min", breeding_date_first_val);
            breeding_date_second.attr("max", expected_pregnancy_day_val);

            expected_pregnancy_day.attr(
                "min",
                breeding_date_second_val
                    ? breeding_date_second_val
                    : breeding_date_first_val
            );
            expected_pregnancy_day.attr("max", expected_birth_date_val);

            pregnancy_day.attr(
                "min",
                breeding_date_second_val
                    ? breeding_date_second_val
                    : breeding_date_first_val
            );
            pregnancy_day.attr("max", expected_birth_date_val);

            expected_birth_date.attr("min", pregnancy_day_val);
            expected_birth_date.attr("max", pregnancy_day_val);
        }

        if (breeding_date_first_val) {
            breeding_date_second.attr("min", breeding_date_first_val);
            expected_pregnancy_day.attr("min", breeding_date_first_val);
            expected_birth_date.attr("min", breeding_date_first_val);
        }

        if (breeding_date_second_val) {
            expected_pregnancy_day.attr("min", breeding_date_second_val);
            expected_birth_date.attr("min", breeding_date_second_val);
        }

        if (expected_pregnancy_day_val) {
            expected_birth_date.attr("min", expected_pregnancy_day_val);
        }

        if (
            new Date(breeding_date_first_val) >=
            new Date(breeding_date_first_val)
        )
            resetPickadate();
    }

    //change date pickadater
    $(document).on("change", 'input[name="oestrous_day"]', function (e) {
        let oestrousDay = $(this).val();
        $(this)
            .parents("form")
            .find('input[name="breeding_date_first"]')
            .val(caculatorDayByDate(oestrousDay, 5));
        $(this)
            .parents("form")
            .find('input[name="breeding_date_second"]')
            .val(caculatorDayByDate(oestrousDay, 5));
        $(this)
            .parents("form")
            .find('input[name="expected_pregnancy_day"]')
            .val(
                caculatorDayByDate(
                    $(this)
                        .parents("form")
                        .find('input[name="breeding_date_first"]')
                        .val(),
                    20
                )
            );
        $(this)
            .parents("form")
            .find('input[name="expected_birth_date"]')
            .val(
                caculatorDayByDate(
                    $(this)
                        .parents("form")
                        .find('input[name="expected_pregnancy_day"]')
                        .val(),
                    114
                )
            );

        resetMaxDate($(this));
    });

    // change breeding date first
    $(document).on("change", 'input[name="breeding_date_first"]', function (e) {
        $(this)
            .parents("form")
            .find('input[name="expected_pregnancy_day"]')
            .val(
                caculatorDayByDate(
                    $(this)
                        .parents("form")
                        .find('input[name="breeding_date_first"]')
                        .val(),
                    20
                )
            );
        $(this)
            .parents("form")
            .find('input[name="expected_birth_date"]')
            .val(
                caculatorDayByDate(
                    $(this)
                        .parents("form")
                        .find('input[name="expected_pregnancy_day"]')
                        .val(),
                    114
                )
            );

        resetMaxDate($(this));
    });

    // change breeding date first
    $(document).on(
        "change",
        'input[name="expected_pregnancy_day"]',
        function (e) {
            $(this)
                .parents("form")
                .find('input[name="expected_birth_date"]')
                .val(
                    caculatorDayByDate(
                        $(this)
                            .parents("form")
                            .find('input[name="expected_pregnancy_day"]')
                            .val(),
                        114
                    )
                );

            resetMaxDate($(this));
        }
    );

    // change breeding date first
    $(document).on("change", 'input[name="birthday"]', function (e) {
        $(this)
            .parents("form")
            .find('input[name="weaning_date"]')
            .val(
                caculatorDayByDate(
                    $(this)
                        .parents("form")
                        .find('input[name="birthday"]')
                        .val(),
                    28
                )
            );

        resetMaxDate($(this));
    });

    $(document).on("click", 'button[type="reset"]', function (e) {
        $(this)
            .parents("form")
            .find(".single-select")
            .val(null)
            .trigger("change");
        $(this)
            .parents("form")
            .find(".select2-ajax-single")
            .val(null)
            .trigger("change");
    });

    $(document).on("change", ".datepicker-from", function (e) {
        let fromDate = $(this).val();
        let toDate = $(this).parents("tr").find(".datepicker-to").val();

        if (
            toDate &&
            new Date(convertDateVnToEn(fromDate)) >
                new Date(convertDateVnToEn(toDate))
        ) {
            $(this).parents("tr").find(".datepicker-to").val("");
        }

        if (fromDate) {
            let newA = $(this)
                .parents("tr")
                .find(".datepicker-to")
                .pickadate({ format: "dd/mm/yyyy" })
                .pickadate("picker");
            newA.set("min", fromDate);
        }
    });
});
