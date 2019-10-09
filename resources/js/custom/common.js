let common = {
    bootstrap: false,
    init: function () {
        if (this.bootstrap) {
            return false;
        }
        this.bootstrap = true;
        this.formatDate();
        this.formatMobile();
        this.formatIdCard();
        this.formatExperience();
    },
    formatMobile: function () {
        if ($(".format-mobile").length) {
            new Cleave('.format-mobile', {
                phone: true,
                phoneRegionCode: 'VI',
            });
        }
    },
    formatIdCard: function () {
        if ($(".format-id-card").length) {
            new Cleave('.format-id-card', {
                creditCard: true,
                blocks: [4, 3, 3, 3],
            });
        }
    },
    formatExperience: function () {
        if ($(".format-experience").length) {
            new Cleave('.format-experience', {
                numeral: true,
                numeralThousandsGroupStyle: 'thousand',
            });
        }
    },
    formatDate: function () {
        $('.format-date').datetimepicker({
            format: 'DD-MM-YYYY',
        });
    },
};

$(document).ready(function () {
    common.init();

    $(function() {
        let members = [];
        $.ajax({
            url: 'list-member',
            method: 'get',
        }).done(function (dataMember) {
            for (let i = 0; i < dataMember.length; i++){
                members.push({
                    value: dataMember[i].full_name,
                    id: dataMember[i].id
                });
            }
        });

        let member_id = [];
        $('#autocomplete').autocomplete({
            lookup: members,
            onSelect: function (suggestion) {
                console.log(suggestion.id);
                $('#autocomplete').val('');
                $('#members').append(
                    '<table class="table table-borderless table-striped table-earning division-table tag-member">'+
                        '<tbody>'+
                            '<tr>'+
                                '<td>'+suggestion.value+'</td>'+
                                '<td>'+
                                    '<span class="delete-member-tag">×</span>'+
                                '</td>'+
                            '</tr>'+
                        '</tbody>'+
                    '</table>'
                );
                member_id.push(suggestion.id);
            }
        });

        $('#submit-team').click(function () {
            let division_id  = $('#division_id').val();
            console.log(division_id);
            let team_name = $('#name').val();
            console.log(team_name);
            let token = $('input[name = _token]').val();
            $.ajax({
                url: "store",
                method: "post",
                data: {
                    'division_id' : division_id,
                    'team_name' : team_name,
                    'memberID' : member_id,
                    '_token' : token,
                },
                success: function (result) {
                }
            });
        });

        // $(document).on('click', '.delete-member-tag', function(current){
        //     let arrMemberTagIdRemove = [];
        //     let tagMember = current.parents('.tag-member');
        //     let MemberTagId = tagMember.attr('data-memberTagId');
        //     arrMemberTagIdRemove.push(MemberTagId);
        //     tagMember.remove();
        // });

    });
});