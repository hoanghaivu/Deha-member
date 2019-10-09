let member = {
	bootstrap: false,
	init: function () {
		if (this.bootstrap) {
			return false;
		}
		this.bootstrap = true;

		$(document).on('click', '.btnDeleteMember', function () {
			member.deleteMember(this);
		});

		$(document).on('click', '#btnConfirmDeleteMember', function () {
			member.confirmDeleteMember();
		});

		$('.show_info').click(function () {
			member.detailMember(this);
		});
	},
	deleteMember: function (obj) {
		let memberId = $(obj).data('id');
		let memberFullName = $(obj).data('name');
		$('#deleteMember #memberId').val(memberId);
		$('#memberFullName').text(memberFullName);
		$('#deleteMember').modal('show');
	},
	confirmDeleteMember:function () {
		$("#formDeleteMember").submit();
	},
	detailMember: function (obj) {
		let data = $(obj).attr('data');

		$.ajax({
			url: "detail",
			method: "GET",
			data: {'idMember':data},
			dataType: "JSON",
			success: function (result) {
				$('#name').html(result.full_name);
				$('#division').html(result.division_name);
				if (result.gender == 0) {
					$('#gender').html('Male');
				} else {
					$('#gender').html('Female');
				}
				$('#birthday').html(result.birthday);
				$('#mobile').html(result.mobile);
				$('#home').html(result.hometown);
				$('#start_date').html(result.start_working_date);
				$('#deha_mail').html(result.deha_mail);
				$('#person_mail').html(result.person_mail);
				$('#facebook').html(result.facebook);
				$('#accommodation').html(result.current_accommodation);
				$('#exp').html(result.experience);
				$('#id_card').html(result.id_card_member);
				$('#date_issued').html(result.date_issued);
				$('#place_issued').html(result.place_issued);
				if (result.marital_status == 0) {
					$('#marital').html('Alone');
				} else {
					$('#marital').html('Married');
				}
				$('#education').html(result.education);
			}
		});
	},
};

$(document).ready(function () {
	member.init();
});