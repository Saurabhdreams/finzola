document.addEventListener("turbo:load", loadTransaction);

function loadTransaction() {
    initializeSelect2Transaction();
    loadDateRangePicker("#transactionDateRangePicker");
}

function initializeSelect2Transaction() {
    if (!select2NotExists("#paymentModeFilter")) {
        return false;
    }
    removeSelect2Container(["#paymentModeFilter"]);

    $("#paymentModeFilter").select2({
        placeholder: "Select Payment Method",
        allowClear: false,
    });
}

function loadDateRangePicker(selector) {
    if (!$(selector).length) {
        return false;
    }

    dateRange = $(selector);
    startDate = moment().subtract(100, "years");
    endDate = moment();
    setDatepickerValue(startDate, endDate);
    const lastMonth = moment().startOf("month").subtract(1, "days");

    dateRange.daterangepicker(
        {
            startDate: startDate,
            endDate: endDate,
            opens: "left",
            showDropdowns: true,
            autoUpdateInput: false,
            locale: {
                customRangeLabel: Lang.get("js.custom"),
                applyLabel: Lang.get("js.apply"),
                cancelLabel: Lang.get("js.cancel"),
                fromLabel: Lang.get("js.from"),
                toLabel: Lang.get("js.to"),
                monthNames: [
                    Lang.get("js.jan"),
                    Lang.get("js.feb"),
                    Lang.get("js.mar"),
                    Lang.get("js.apr"),
                    Lang.get("js.may"),
                    Lang.get("js.jun"),
                    Lang.get("js.jul"),
                    Lang.get("js.aug"),
                    Lang.get("js.sep"),
                    Lang.get("js.oct"),
                    Lang.get("js.nov"),
                    Lang.get("js.dec"),
                ],
                daysOfWeek: [
                    Lang.get("js.sun"),
                    Lang.get("js.mon"),
                    Lang.get("js.tue"),
                    Lang.get("js.wed"),
                    Lang.get("js.thu"),
                    Lang.get("js.fri"),
                    Lang.get("js.sat"),
                ],
            },
            ranges: {
                [Lang.get("js.all")]: [
                    moment().subtract(100, "years"),
                    moment(),
                ],
                [Lang.get("js.today")]: [moment(), moment()],
                [Lang.get("js.this_week")]: [
                    moment().startOf("week"),
                    moment().endOf("week"),
                ],
                [Lang.get("js.last_week")]: [
                    moment().startOf("week").subtract(7, "days"),
                    moment().startOf("week").subtract(1, "days"),
                ],
                [Lang.get("js.last_30")]: [
                    moment().subtract(29, "days"),
                    moment(),
                ],
                [Lang.get("js.this_month")]: [
                    moment().startOf("month"),
                    moment().endOf("month"),
                ],
                [Lang.get("js.last_month")]: [
                    lastMonth.clone().startOf("month"),
                    lastMonth.clone().endOf("month"),
                ],
            },
        },
        setDatepickerValue
    );

    function setDatepickerValue(start, end) {
        dateRange.val(
            start.format("DD/MM/YYYY") + " - " + end.format("DD/MM/YYYY")
        );
    }

    dateRange.on("apply.daterangepicker", function (ev, picker) {
        startDate = picker.startDate.format("YYYY-MM-D");
        endDate = picker.endDate.format("YYYY-MM-D");
        window.livewire.emit("changeDateRangeFilter", [startDate, endDate]);
    });
}

listenChange(".payment-mode-filter", function () {
    window.livewire.emit("changePaymentModeFilter", $(this).val());
});

listenChange(".payment-status-filter", function () {
    window.livewire.emit("changePaymentStatusFilter", $(this).val());
});

listenClick("#transactionResetFilter", function () {
    $(".payment-mode-filter").val("").trigger("change");
    $(".payment-status-filter").val("").trigger("change");
    hideDropdownManually($("#transactionFilterBtn"), $(".dropdown-menu"));
    let startDate = moment().subtract(100, "years");
    let endDate = moment();
    window.livewire.emit("changeDateRangeFilter", [startDate, endDate]);
    loadDateRangePicker("#transactionDateRangePicker");
});

listenClick(".show-payment-notes", function () {
    let paymentId = $(this).attr("data-id");
    paymentData(paymentId);
});

function paymentData(paymentId) {
    $.ajax({
        url: route("payment-notes.show", paymentId),
        type: "GET",
        success: function (result) {
            if (result.success) {
                let notes = isEmpty(result.data) ? "N/A" : result.data;
                $("#showClientNotesId").text(notes);
                $("#paymentNotesModal").appendTo("body").modal("show");
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
    });
}
