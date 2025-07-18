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
                    _this.append(option).trigger("change", { isAjax: false });
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

function initializeSelect2AjaxAll() {
    $(".select2-ajax-single-all").each(function () {
        var $select = $(this);
        var url = $select.data("url"); // Lấy URL từ thuộc tính data-url
        var selectedId = $select.data("selected-id"); // Lấy giá trị từ data-selected-id

        // Gửi AJAX để tải toàn bộ dữ liệu một lần
        $.ajax({
            url: url,
            method: "GET",
            dataType: "json",
            success: function (data) {
                // Xử lý dữ liệu trả về và thêm vào Select2
                var options = [];
                data.items.forEach(function (item) {
                    let _selected = item.id == selectedId ? true : false;
                    options.push(
                        new Option(item.name, item.id, _selected, _selected)
                    );
                });

                $select.append(options).trigger("change");

                // Khởi tạo Select2
                $select.select2({
                    theme: "bootstrap4",
                    placeholder: $select.data("placeholder") || "Chọn một mục",
                    allowClear: true,
                    minimumInputLength: 0, // Không yêu cầu nhập ký tự
                });

                $('.remove-loaded-ajax').remove();
            },
            error: function (xhr) {
                console.error("Error loading data for Select2:", xhr);
            },
        });
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

function runTimePicker() {
    flatpickr(".cs-time-picker", {
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
        time_24hr: true,
    });
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

function formatCsNumerics(input) {
    var value = input.val();
    var decimalPlaces = 2; // Số lượng số sau dấu thập phân

    // Loại bỏ tất cả các ký tự không phải số hoặc dấu chấm
    value = value.replace(/[^0-9.]/g, "");

    // Đảm bảo chỉ có một dấu chấm
    var parts = value.split(".");
    if (parts.length > 2) {
        value = parts[0] + "." + parts.slice(1).join("");
    }

    // Giới hạn số lượng số sau dấu thập phân
    if (parts.length > 1 && parts[1].length > decimalPlaces) {
        parts[1] = parts[1].substring(0, decimalPlaces);
        value = parts.join(".");
    }

    // Định dạng hàng ngàn
    var integerPart = parts[0];
    var decimalPart = parts.length > 1 ? "." + parts[1] : "";
    integerPart = integerPart.replace(/\B(?=(\d{3})+(?!\d))/g, ",");

    var formattedValue = integerPart + decimalPart;
    input.val(formattedValue);

    // Cập nhật giá trị cho input ẩn
    var hiddenInput = input.siblings('input[type="hidden"]');
    hiddenInput.val(value.replace(/,/g, ""));
    return formattedValue;
}

function formatCsThousands(input) {
    var value = input.val();

    // Loại bỏ tất cả các ký tự không phải số
    value = value.replace(/[^0-9]/g, "");

    // Định dạng hàng ngàn
    value = value.replace(/\B(?=(\d{3})+(?!\d))/g, ",");

    input.val(value);

    // Cập nhật giá trị cho input ẩn
    var hiddenInput = input.siblings('input[type="hidden"]');
    hiddenInput.val(value.replace(/,/g, ""));
    return value;
}

function resetNumericText() {
    jQuery(".numeric-text, .thousand-text").each(function () {
        var input = jQuery(this);
        var name = input.attr("name") ?? input.attr("data-name");
        var value = input.val();
        input.siblings('input[type="hidden"]').remove();

        // Nếu input có giá trị, tiến hành định dạng tương ứng
        if (value) {
            if (input.hasClass("numeric-text")) {
                value = formatCsNumerics(input);
            } else if (input.hasClass("thousand-text")) {
                value = formatCsThousands(input);
            }
            input.val(value);
        }

        // Tạo input ẩn và cập nhật giá trị đã định dạng
        input.removeAttr("name");
        input.attr("data-name", name);
        input.after(
            '<input type="hidden" name="' +
                name +
                '" value="' +
                value.replace(/,/g, "") +
                '">'
        );
    });
}

function addBgToTableByDate(elem) {
    const rows = $("table tbody tr");
    let currentDate = null;
    let toggleClass = false;
    console.log(rows.length);

    rows.each(function (index) {
        const row = $(this);
        const dateText = row.find(elem).text().trim();

        // Nếu ngày khác với ngày trước đó, đảo trạng thái toggle
        if (dateText !== currentDate) {
            currentDate = dateText;
            toggleClass = !toggleClass;
        }

        // Nếu toggleClass đang true thì thêm class
        if (toggleClass) {
            row.addClass("bg-aa");
        }
    });
}

$(function () {
    // sidebar scroll top active
    function scrollTopMenuSidebar() {
        var $sidebarWrapper = $(".sidebar-wrapper");
        var $contentWrapper = $sidebarWrapper.find(
            ".simplebar-content-wrapper"
        );
        var $firstActive = $sidebarWrapper.find("li.mm-active").first();

        if ($firstActive.length && $contentWrapper.length) {
            // Tính vị trí của item so với content wrapper
            var itemOffset =
                $firstActive.offset().top - $contentWrapper.offset().top;
            var scrollTo = itemOffset - 100;
            if (scrollTo < 0) scrollTo = 0;

            $contentWrapper.animate({ scrollTop: scrollTo }, 400);
        }
    }
    $(window).on("load", function () {
        scrollTopMenuSidebar();
    });
    // end scroll top

    runTimePicker();
    resetNumericText();

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
    initializeSelect2AjaxAll();

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
                    addClassTableResponsive();
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

    $(document).on("submit", ".form-search-submit", function (e) {
        e.preventDefault();
        var $button = $(this).find('button[type="submit"]');
        var $spinner = $button.find(".spinner-border");
        var $elReload = $(this).attr("data-reload");
        var $elmLoadDataAjax = $(this).attr("id");

        // Hiển thị spinner và disabled button
        $spinner.show();
        $button.prop("disabled", true);

        let _url = $(`div[data-search="#${$elmLoadDataAjax}"]`).attr(
            "data-url"
        );
        $($elmLoadDataAjax).data("url", _url);

        loadDataAjax($elReload, function () {
            // Ẩn spinner và bỏ disabled button sau khi gọi AJAX xong
            $spinner.hide();
            $button.prop("disabled", false);
        });
    });

    $(document).on("click", ".load-data-ajax .pagination a", function (e) {
        e.preventDefault();
        var url = $(this).attr("href");
        var elReload = $(this).closest(".load-data-ajax").attr("id");
        $(this).closest(".load-data-ajax").data("url", url);
        loadDataAjax(`#${elReload}`);
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
        $(".modal:not(.no-remove)").each(function () {
            $(this).modal("hide"); // Ẩn modal
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
                resetNumericText();
                runTimePicker();
                initializeSelect2AjaxAll();
            },
            error: function (xhr) {
                console.error("Error loading create modal:", xhr);
            },
        });
    });

    $(document).on("click", ".btn-show-list-ajax", function (e) {
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
                $(elmModal).find(".form-search-submit").submit();
            },
            error: function (xhr) {
                console.error("Error loading create modal:", xhr);
            },
        });
    });

    $(document).on("click", ".btn-show-list-ajax-dat", function (e) {
        e.preventDefault();
        $(".course-user-table-container").removeClass("show-to-table");
        $(".table-course-right").html("");
        var url = $(this).attr("href");
        $.ajax({
            url: url,
            method: "GET",
            success: function (response) {
                $(".course-user-table-container").addClass("show-to-table");
                $(".table-course-right").html(response);
            },
            error: function (xhr) {
                console.error("Error loading create modal:", xhr);
            },
        });
    });

    $(document).on("click", ".close-show-dat", function (e) {
        e.preventDefault();
        $(".table-course-right").html("");
        $(".course-user-table-container").removeClass("show-to-table");
    });

    $(document).on("click", ".btn-show-list-ajax-dat", function (e) {
        e.preventDefault();
        $(".course-user-table-container").removeClass("show-to-table");
        $(".table-course-right").html("");
        var url = $(this).attr("href");
        $.ajax({
            url: url,
            method: "GET",
            success: function (response) {
                $(".course-user-table-container").addClass("show-to-table");
                $(".table-course-right").html(response);
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
                resetNumericText();
                runTimePicker();
                initializeSelect2AjaxAll();
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
                // Xác nhận lần thứ hai
                Swal.fire({
                    title: "Xác nhận lần cuối!",
                    text: "Bạn có chắc chắn muốn xóa bản ghi này? Hành động này không thể hoàn tác!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Vâng, Xóa!",
                    cancelButtonText: "Hủy",
                }).then((finalResult) => {
                    if (finalResult.isConfirmed) {
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
            }
        });
    });

    // Thay đổi học viên
    $("body").on(
        "change",
        "#change-hoc-vien",
        function (e, extraData = { isAjax: true }) {
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
        }
    );

    //THay đổi khoá học, hiển thị học phí
    $("body").on(
        "change",
        "#change-khoa-hoc",
        function (e, extraData = { isAjax: true }) {
            var courseID = $(this).val();
            if (courseID && extraData.isAjax) {
                $.ajax({
                    url: `/admin/courses/${courseID}/detail`,
                    type: "GET",
                    success: function (data) {
                        $("#tuition_fee").val(
                            data.tuition_fee > 0 ? data.tuition_fee : ""
                        );
                        resetNumericText();
                    },
                    error: function () {
                        alert("Failed to fetch course details.");
                    },
                });
            }
        }
    );

    function loadStatusCalendar() {
        var type = $(".type-calendars:checked").val();
        if (!type) {
            type = $(".type-calendars").val();
        }

        var statusSelect = $("#status-calendar");
        statusSelect.empty();

        if (statusCalendars[type]) {
            $.each(statusCalendars[type], function (key, value) {
                statusSelect.append(
                    '<option value="' + key + '">' + value + "</option>"
                );
            });
        }
    }

    $("body").on("change", ".type-calendars", function () {
        loadStatusCalendar();
    });

    $("body").on("change", 'input[name="loai_hoc"]', function (e) {
        var loai_hoc = $(this).val();
        let lists = obj_config.status_approved_km;
        if (lists.includes(loai_hoc)) {
            $(this).closest("form").find("#show-select-dat").show();
            $(this).closest("form").find(".cs-approval").show();
        } else {
            $(this).closest("form").find("#show-select-dat").hide();
            $(this).closest("form").find(".cs-approval").hide();
        }
    });

    $("body").on("change", ".status-calendar", function (e) {
        let status = $(this).val();
        if (status == obj_config.status_calendar_cancel) {
            $(this).closest("form").find(".reason-cancel").show();
        } else {
            $(this).closest("form").find(".reason-cancel").hide();
        }
    });

    function addClassTableResponsive() {
        $(".table-responsive").each(function () {
            let tableResponsive = $(this);
            tableResponsive.next(".scrollbar-container").remove();

            // Kiểm tra nếu bảng có thanh cuộn ngang
            if (
                tableResponsive.get(0).scrollWidth >
                tableResponsive.innerWidth()
            ) {
                // Tạo thanh cuộn ngang bên dưới
                let scrollbarContainer = $(
                    '<div class="scrollbar-container"><div class="scrollbar"><div class="scroll-content"></div></div></div>'
                );
                tableResponsive.after(scrollbarContainer);

                let scrollbar = scrollbarContainer.find(".scrollbar");
                let scrollContent = scrollbarContainer.find(".scroll-content");

                // Đặt chiều rộng thanh cuộn ngang bằng với bảng
                scrollContent.width(tableResponsive.get(0).scrollWidth);
                scrollbarContainer.show();

                // Đồng bộ cuộn ngang
                scrollbar.on("scroll", function () {
                    tableResponsive.scrollLeft($(this).scrollLeft());
                });

                tableResponsive.on("scroll", function () {
                    scrollbar.scrollLeft($(this).scrollLeft());
                });
            }
        });
    }

    addClassTableResponsive();

    resetSelectAjax();

    $("body").on("input", ".numeric-text", function (e) {
        var input = $(this);
        formatCsNumerics(input);
    });

    $("body").on("input", ".thousand-text", function (e) {
        var input = $(this);
        formatCsThousands(input);
    });

    $("body").on("click", ".btn-outline-danger", function (e) {
        $("#modal-leads-convert-ajax").modal("show");
    });

    $("body").on("change", ".select-option-type-user-lead", function (e) {
        $(".box-lead-exist-user").hide();
        $(".box-lead-not-user").hide();
        if ($(this).val() == 1) {
            $(".box-lead-exist-user").show();
        } else {
            $(".box-lead-not-user").show();
        }
    });

    $("body").on("change", ".select-option-type-course-lead", function (e) {
        $(".box-lead-exist-course").hide();
        $(".box-lead-not-course").hide();
        if ($(this).val() == 1) {
            $(".box-lead-exist-course").show();
        } else {
            $(".box-lead-not-course").show();
        }
    });

    $(document).on("submit", ".form-submit-ajax-convert-lead", function (e) {
        e.preventDefault();
        var $form = $(this);
        var url = $form.attr("action");
        var method = $form.attr("method");
        var data = $form.serialize();

        $.ajax({
            url: url,
            method: method,
            data: data,
            success: function (response) {
                if (response.success) {
                    Swal.fire({
                        icon: "success",
                        title: "Chuyển đổi thành công",
                        text: response.success,
                        timer: 2000,
                        showConfirmButton: false,
                    });
                    $form[0].reset();
                    $form.closest(".modal").modal("hide");
                    setTimeout(function () {
                        window.location.reload();
                    }, 2000);
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

    $(document).on("change", ".select2-ajax-single-calendar", function (e) {
        let selectedValue = $(this).val();
        $(".diem-thi-cs").remove();
        if (!selectedValue) return;
        var _this = $(this);

        // Ví dụ: Gửi AJAX để lấy dữ liệu liên quan
        $.ajax({
            url: `/admin/course-user/${selectedValue}/detail`, // Thay bằng URL API của bạn
            method: "GET",
            data: { id: selectedValue },
            success: function (response) {
                if (response.exam) {
                    _this
                        .parent()
                        .append(
                            `<p class="diem-thi-cs text-danger mt-1"><i>Điểm thi:</i> ${response.exam}</p>`
                        );
                }
                // Xử lý dữ liệu trả về
            },
            error: function (xhr) {
                console.error("Lỗi khi gọi API:", xhr);
            },
        });
    });

    $(document).ready(function () {
        // Lắng nghe sự kiện click trên các liên kết trong sidebar
        $("a.reset-search-action").on("click", function (e) {
            e.preventDefault(); // Ngăn chặn hành động mặc định của liên kết

            var link = $(this).attr("href"); // Lấy URL của liên kết

            // Gửi yêu cầu AJAX để xóa filters
            $.ajax({
                url: "/clear-filters",
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ), // Thêm CSRF token
                },
                success: function (response) {
                    if (response.success) {
                        // Sau khi xóa filters, điều hướng đến URL của liên kết
                        window.location.href = link;
                    }
                },
                error: function () {
                    console.error("Không thể xóa filters.");
                    // Điều hướng đến URL ngay cả khi có lỗi
                    window.location.href = link;
                },
            });
        });
    });

    // Lắng nghe sự kiện change trên trường date_start_change
    $(document).on("change", ".date_start_change", function () {
        // Lấy giá trị ngày từ trường date_start_change
        let selectedDate = $(this).val();

        // Kiểm tra nếu ngày được chọn
        if (selectedDate) {
            // Cập nhật các tùy chọn trong select#date_start
            $("#date_start").html(`
                <option>Chọn thời gian</option>
                <option value="${selectedDate} 07:00:00">Sáng</option>
                <option value="${selectedDate} 13:00:00">Chiều</option>
            `);
        }
    });
});
