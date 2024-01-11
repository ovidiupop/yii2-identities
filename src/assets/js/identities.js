const loadPersonIdentifierType = (country) => {
    $.ajax({
        type: 'GET',
        dataType: 'JSON',
        data: {country},
        url: '/identities/identity/load-person-identifier-type',
        success: (response) => {
            const labelElement = $('label[for="identitydata-person_identifier"]');
            labelElement.text(response.type);
            $('.person_identifier_type_id').val(response.id);
        },
        error: (response) => {
            alert(response.responseText);
        }
    });
};

const handleIdentifierTypeChange = () => {
    const country = $('.geography-select.country').val();
    const person = $('.identifier-type-select').val();
    if (person === '1') {
        loadPersonIdentifierType(country);
    } else {
        $('.person_identifier_type_id').val("");
    }
};

function togglePersonCompany() {
    var type = $('.identifier-type-select').val();
    $('.person-data').toggle(type !== '2');
    $('.company-data').toggle(type === '2');
};

$(document).ready(function () {
    $('.identifier-type-select, .geography-select.country').on('change', handleIdentifierTypeChange);
    togglePersonCompany();
});