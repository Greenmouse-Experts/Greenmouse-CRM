$.validator.setDefaults({
	submitHandler: function () {
		form.submit();

		var submitButton = $('#jQueryValidationForm');
		var spinner = submitButton.find('.spinner-border');
		
		submitButton.prop('disabled', true); // Disable the submit button
		spinner.removeClass('d-none'); // Show the spinner
	}
});

$.validator.addMethod('nigeriaPhone', function(phoneNumber, element) {
	phoneNumber = phoneNumber.replace(/\s+/g, ''); // Remove spaces
	return this.optional(element) || phoneNumber.match(/^(\+?234|0)[789]\d{9}$/);
}, 'Please enter a valid phone number.');


$(document).ready(function () {

	$("#jQueryValidationForm").validate({
		rules: {
			name: "required",
			phone_number: {
				required: true,
				nigeriaPhone: true
			},
			// username: {
			// 	required: true,
			// 	minlength: 2
			// },
			gender: "required",
			// password: {
			// 	required: true,
			// 	minlength: 5
			// },
			// confirm_password: {
			// 	required: true,
			// 	minlength: 5,
			// 	equalTo: "#input38"
			// },
			email: {
				required: true,
				email: true
			},
			head_of_branch_name: "required",
			state: "required",
			address: "required",
		},
		messages: {
			name: "Please enter your your name",
			phone_number: {
				required: "Please enter your phone number"
				// number: "Please enter a valid phone number."
			},
			// username: {
			// 	required: "Please enter a username",
			// 	minlength: "Your username must consist of at least 2 characters"
			// },
			gender: "Please select gender",
			// password: {
			// 	required: "Please provide a password",
			// 	minlength: "Your password must be at least 5 characters long"
			// },
			// confirm_password: {
			// 	required: "Please provide a password",
			// 	minlength: "Your password must be at least 5 characters long",
			// 	equalTo: "Please enter the same password as above"
			// },
			email: "Please enter a valid email address",
			head_of_branch_name: "Please enter head of branch name",
			state: "Please select state",
			address: "Please type address",
		},
	});

	$("#jQueryValidationSupportForm").validate({
		rules: {
			subject: "required",
			message: "required",
			// uploadFile: {
			// 	required: true,
            //     accept: "image/jpeg, application/pdf, application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document", // Allowed file types
            //     filesize: 10485760 // Max file size in bytes (10MB)
			// },
		},
		messages: {
			subject: "Please enter your subject",
			message: "Please enter your message",
			// uploadFile: {
			// 	accept: "Please select a valid file type (JPEG, PDF, Word document).",
            //     filesize: "File size must be less than 10MB."
			// },
		},
	});

	$('#yesCapicity').on('change', function() {
        if ($(this).prop('checked')) {
            $('#capicity').show();
        } else {
            $('#capicity').hide();
        }
    });

    $('#noCapicity').on('change', function() {
        if ($(this).prop('checked')) {
            $('#capicity').hide();
        }
    });

	//Juvenile Rehabilitation
	$('#yesJuvenileRehabilitation').on('change', function() {
        if ($(this).prop('checked')) {
            $('#juvenilerehabilitation').show();
        } else {
            $('#juvenilerehabilitation').hide();
        }
    });

    $('#noJuvenileRehabilitation').on('change', function() {
        if ($(this).prop('checked')) {
            $('#juvenilerehabilitation').hide();
        }
    });

	// Gender Champion
	$('#yesGenderChampion').on('change', function() {
        if ($(this).prop('checked')) {
            $('#genderchampion').show();
        } else {
            $('#genderchampion').hide();
        }
    });

    $('#noGenderChampion').on('change', function() {
        if ($(this).prop('checked')) {
            $('#genderchampion').hide();
        }
    });

	// Barrier Enable Women
	$('#yesBarrierEnableWomen').on('change', function() {
        if ($(this).prop('checked')) {
            $('#barrierenablewoman').show();
        } else {
            $('#barrierenablewoman').hide();
        }
    });

    $('#noBarrierEnableWomen').on('change', function() {
        if ($(this).prop('checked')) {
            $('#barrierenablewoman').hide();
        }
    });

	// Disability Act
	$('#yesDisabilityAct').on('change', function() {
        if ($(this).prop('checked')) {
            $('#disabilityact').show();
        } else {
            $('#disabilityact').hide();
        }
    });

    $('#noDisabilityAct').on('change', function() {
        if ($(this).prop('checked')) {
            $('#disabilityact').hide();
        }
    });

	// Case Women
	$('#yesCaseWomen').on('change', function() {
        if ($(this).prop('checked')) {
            $('#casewomen').show();
        } else {
            $('#casewomen').hide();
        }
    });

    $('#noCaseWomen').on('change', function() {
        if ($(this).prop('checked')) {
            $('#casewomen').hide();
        }
    });

	// Service Providers
	$('#yesServiceProviders').on('change', function() {
        if ($(this).prop('checked')) {
            $('#serviceProviders').show();
        } else {
            $('#serviceProviders').hide();
        }
    });

    $('#noServiceProviders').on('change', function() {
        if ($(this).prop('checked')) {
            $('#serviceProviders').hide();
        }
    });

	// Referral Details
	$('#yesReferral').on('change', function() {
        if ($(this).prop('checked')) {
            $('#referralDetails').show();
        } else {
            $('#referralDetails').hide();
        }
    });

    $('#noReferral').on('change', function() {
        if ($(this).prop('checked')) {
            $('#referralDetails').hide();
        }
    });

	// Validation 
	$('#yesLiveAlone').on('change', function() {
		if ($(this).prop('checked')) {
            $('#liveAlone').hide();
        }
    });

    $('#noLiveAlone').on('change', function() {
        if ($(this).prop('checked')) {
            $('#liveAlone').show();
        } else {
            $('#liveAlone').hide();
        }
    });

	$("#jQueryValidationCaseForm").validate({
		rules: {
			name_of_organization: "required",
			state: "required",
			branch: "required",
			date_reporting: "required",
			case_file_number: "required",
			designation_of_officer_completing_the_form: "required",
			survivor_name: "required",
			survivor_age: "required",
			survivor_gender: "required",
			survivor_marital_status: "required",
			survivor_employment_status: "required",
			survivor_live_alone: "required",
			date_of_incident: "required",
			subject_matter: "required",
			status_of_mattter: "required",
			referral: "required",
			how_matter_was_resolved: "required",
			hear_of_fida: "required",
		},
		messages: {
			name_of_organization: "Please enter name of organization.",
			state: "Please enter state.",
			branch: "Please enter branch.",
			date_reporting: "Please enter date of reporting.",
			case_file_number: "Please enter case file number.",
			designation_of_officer_completing_the_form: "Please select designation of officer completing this form.",
			survivor_name: "Please enter survivor name.",
			survivor_age: "Please enter survivor age.",
			survivor_gender: "Please select survivor gender.",
			survivor_marital_status: "Please select marital status.",
			survivor_employment_status: "Please select employment status.",
			survivor_live_alone: "Please indicate if survivor lives alone.",
			date_of_incident: "Please enter date of incident.",
			subject_matter: "Please select subject matter.",
			status_of_mattter: "Please select status of the matter.",
			referral: "Please enter referral",
			how_matter_was_resolved: "Please select how matter was resolved.",
			hear_of_fida: "Please select where you heard of fida.",
		},
	});

	$("#jQueryValidationParalegalForm").validate({
		rules: {
			email: "required",
			date_survey: "required",
			branch_name: "required",
			names_survey: "required",
			new_members_branch: "required",
			no_branch_2021: "required",
			no_branch_2022: "required",
			capacity_building_workshop_2021_2022: "required",
			proposals_review_period: "required",
			proposals_donor_agencies_partners: "required",
			successful_proposals: "required",
			fundraising_events: "required",
			annual_budget: "required",
			branch_audited_accounts: "required",
			legal_clinics_2021_2022: "required",
			case_referred_by_tcp: "required",
			juvenile_rehabilitation: "required",
			advocacy_visit: "required",
			gender_champion_2021_2022: "required",
			strategic_litigation_cases_many: "required",
			strategic_litigation_cases_list: "required",
			barrier_enable_women: "required",
			advocacy_visit_stakeholders: "required",
			disability_act: "required",
			cases_of_woman_political: "required",
			trained_community_paralegas_TC: "required",
			trained_community_paralegas_ID: "required",
			community_paralegals_handle: "required",
			directory_service_providers: "required",
			community_paralegals_access_directory: "required"
		},
	});



	$('#isState').change(updateSelectedValue);

	function updateSelectedValue() {
		var selectedValue = $('#isState').val();

		$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })
        $.ajax({
            url: "/admin/dashboard",
            method: "get",
            data: {
                state: selectedValue,
            },
            success: function(result) {
                $('#stateName').html(result.stateName);
                $('#branchCount').html(result.branchCount);
            }
        })
	}
});