  
<?php
    $type = "";
    $start_lbl = "";
    $end_lbl = "";

    if (isset($_GET['type'])) {
        $type = filter_input(INPUT_GET, 'type', FILTER_SANITIZE_SPECIAL_CHARS); 
    }         

    if($type == "arousal"){
        $start_lbl = 'Very Calm';
        $end_lbl = 'Very Excited';
    }else if($type == "valence"){
        $start_lbl = 'Very Negative';
        $end_lbl = 'Very Positive';
    }else if($type == "dominance"){
        $start_lbl = 'Out of Control';
        $end_lbl = 'In Control';
    }
?>

<input onblur="this.focus()" autofocus id="slider" data-slider-id='annoSlider' type="text" data-slider-min="-1" data-slider-max="1" data-slider-step="0.001" data-slider-value="0" data-slider-ticks="[-1, 0, 1]"
data-slider-ticks-labels='["<b><?php echo $start_lbl ?></b>", "0", "<b><?php echo $end_lbl ?></b>"]'/>

<!--carico immagine del sam in base al tipo di video-->
<div class="sam">
        <?php 
        if($type == "arousal"){
            echo '<p></p><p>This is for measuring emotion according to how positive or negative one feels about something.</p> 
            <ul>
            <li>Face</> 
            <li>Head (examples include: position, rotation, tilt, nod, shake)</li>
            <li>Torso (examples include: left–right trunk rotation, left trunk turn, torso bending)</li>
            <li>Arms (examples include: both arms held in front, palm touching, clenched fists, pointing, hands-on waist, hands raised with palms out, palms shaking)</>
            <li>Leg movement (examples include: any movement of the lower limbs, leg fidgeting)</>
            <li>Whole-body (examples include: fidgeting, slouched sitting position)</li>
            <li>Voice</li>
            </ul>';
        }else if($type == "valence"){
            echo '<p></p><p>This is for measuring emotion ranging from very calm to extreme excitement, irrespective of whether the emotion is positive or negative. </p>
            <ul>
            <li>Face</> 
            <li>Head (examples include: position, rotation, tilt, nod, shake)</li>
            <li>Torso (examples include: left–right trunk rotation, left trunk turn, torso bending)</li>
            <li>Arms (examples include: both arms held in front, palm touching, clenched fists, pointing, hands-on waist, hands raised with palms out, palms shaking)</>
            <li>Leg movement (examples include: any movement of the lower limbs, leg fidgeting)</>
            <li>Whole-body (examples include: fidgeting, slouched sitting position)</li>
            <li>Voice</li>
            </ul>';
        }else if($type == "dominance"){
            echo '<p></p><p>This is for measuring how much control the person appears to have over their emotions.</p>
            <ul>
            <li>Face</> 
            <li>Head (examples include: position, rotation, tilt, nod, shake)</li>
            <li>Torso (examples include: left–right trunk rotation, left trunk turn, torso bending)</li>
            <li>Arms (examples include: both arms held in front, palm touching, clenched fists, pointing, hands-on waist, hands raised with palms out, palms shaking)</>
            <li>Leg movement (examples include: any movement of the lower limbs, leg fidgeting)</>
            <li>Whole-body (examples include: fidgeting, slouched sitting position)</li>
            <li>Voice</li>
            </ul>';
        }
        ?>
</div>
