$('.packageDropdown').on('change', function () {
    var selectedPackage = $(this).val();

    if (selectedPackage) {
        $.ajax({
            url: 'get-month-by-package', 
            method: 'post',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                pacakge: selectedPackage,
            },
            success: function (response) {
                console.log('month:', response);

                // Clear and populate the package list
                let MonthList = $('#year');
                MonthList.empty();
                MonthList.append('<option value="">Select Month</option>');
                
                if (response.length > 0) {
                    response.forEach(month => {
                        MonthList.append(`<option value="${month}">${month}</option>`);
                    });
                } else {
                    monthDropdown.append('<option value="">No months available</option>');
                }
            },
            error: function (error) {
                console.error('Error fetching packages:', error);
            }
        });
    }



});