
$(document).ready(function() {
    $('#mySelect').on('change', function() {
        var selectedOption = $(this).val();

            $('.deleted').hide();
            $('.deletedInput').val(' ');

        $('.made_in select').attr('required', false);
        $('.made_in select').val(' ');

        $('.rechargeable select').attr('required', false);
        $('.rechargeable select').val('  ');

        $('.taste select').attr('required', false);
        $('.taste select').val(' ');

        $('.strength input').attr('required', false);
        $('.strength input').val(' ');

        $('.puffs_count input').attr('required', false);
        $('.puffs_count input').val(' ');

        if (selectedOption == 9 || selectedOption == 12 || selectedOption == 4 || selectedOption == 3){
            $('.made_in').show()
            $('.made_in select').attr('required', true);
            $('.taste').show()
            $('.taste select').attr('required', true);
            $('.volume').show()
            $('.volume input').attr('required', true);
            $('.strength').show();
            $('.strength input').attr('required', true);
        }

        if (selectedOption == 7){
            $('.puffs_count').show()
            $('.puffs_count input').attr('required', true);
            $('.rechargeable').show()
            $('.rechargeable select').attr('required', true);
            $('.strength').show();
            $('.strength input').attr('required', true);
            $('.made_in').show()
            $('.made_in select').attr('required', true);
            $('.taste').show()
            $('.taste select').attr('required', true);
            $('.puffs_count').show()
            $('.puffs_count input').attr('required', true);
        }

        if (selectedOption == 11 || selectedOption == 10){
            $('.resistance').show()
            $('.resistance input').attr('required', true)
            $('.manufacturers_recommended_power').show()
            $('.manufacturers_recommended_power input').attr('required', true)
            $('.which_device_is_suitable_for_this_vaporizer').show()
            $('.which_device_is_suitable_for_this_vaporizer input').attr('required', true)
        }
        if(selectedOption == 8){
            $('.made_in').show()
            $('.made_in select').attr('required', true);

            $('.output_power').show()
            $('.output_power input').attr('required', true);

            $('.evaporator_resistance').show()
            $('.evaporator_resistance input').attr('required', true);

            $('.cartridge_volume').show()
            $('.cartridge_volume input').attr('required', true);
            $('.battery_capacity').show()
            $('.battery_capacity input').attr('required', true);
            $('.equipment').show()
            $('.equipment input').attr('required', true);
            $('.screen').show()
            $('.screen input').attr('required', true);


            $('.replacement_coils').show()
            $('.replacement_coils input').attr('required', true);

            $('.maximum_power').show()
            $('.maximum_power input').attr('required', true);
            $('.battery_type').show()
            $('.battery_type input').attr('required', true);


        }
        
        if (selectedOption == 6){
            $('.size').show()
            $('.size input').attr('required', true);
            $('.capacity').show()
            $('.capacity input').attr('required', true);
            $('.marking').show()
            $('.marking input').attr('required', true);


        }
    });
});
