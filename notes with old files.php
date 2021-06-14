
<form id="behavior" style="display: none">
    <br>
     <label>Select the behaviors that influenced your ratings:</label>
        <br>
          <input type="checkbox" name="behavior" id="faceTouch">
          <label for="faceTouch">Face touching/rubbing</label><br>

          <input type="checkbox" name="behavior" id="neckRubbing">
          <label for="neckRubbing">Neck rubbing</label><br>

          <input type="checkbox" name="behavior" id="torsoBending">
          <label for="torsoBending">Torso bending</label><br>

          <input type="checkbox" name="behavior" id="leftrightTR">
          <label for="leftrightTR">Left–right trunk rotation (A rotation of the trunk around the vertical axis that result in shaking the trunk)</label><br>
          
          <input type="checkbox" name="behavior" id="trunkTurn">
          <label for="trunkTurn">Left Trunk turn (A left rotation of the trunk around the vertical axis)</label><br>

          <input type="checkbox" name="behavior" id="bothArms">
          <label for="bothArms">Both arms held in front</label><br>

          <input type="checkbox" name="behavior" id="palmTouch">
          <label for="palmTouch">Palm touching</label><br>

          <input type="checkbox" name="behavior" id="clenchedFist">
          <label for="clenchedFist">Clenched fists</label><br>

          <input type="checkbox" name="behavior" id="pointing">
          <label for="pointing">Pointing</label><br>

          <input type="checkbox" name="behavior" id="handsOnWaist">
          <label for="handsOnWaist">Hands on waist</label><br>

          <input type="checkbox" name="behavior" id="handPalmout">
          <label for="handPalmout">Hands raised with palms out</label><br>

          <input type="checkbox" name="behavior" id="palmshake">
          <label for="palmshake">Palms shaking</label><br>

          <input type="checkbox" name="behavior" id="slouched">
          <label for="slouched">Slouched sitting position</label><br>

          <input type="checkbox" name="behavior" id="legsMove">
          <label for="legsMove">Legs movement (Any movement of the lower limbs)</label><br>

          <input type="checkbox" name="behavior" id="legsFidget">
          <label for="legsFidget">Leg fidgeting </label><br>

          <input type="checkbox" name="behavior" id="fidgeting">
          <label for="fidgeting">Fidgeting</label><br>
          
          <label for="others">Others (Please specify)</label>
          <input type="text" name="behavior" id="others"><br>
          
          <button type="submit" id="submit-behavior" class="btn btn-info">
            Submit
          </button>
</form>




   static function addAnnotation($data){
            
            $userId = $data->userId;
            $video = $data->video;
            $type = $data->type;


            if ($GLOBALS['save_mode'] == 'db') {
                
                global $conn;

                if (strpos($type, 'behavior') !== false){

                    $stmt = $conn->prepare("INSERT INTO behavior VALUES (?,?,?,?,?,?,?,?,NULL);");
                    $stmt->bind_param("sssiiiis", $userId, $video, $type, $data->faceTouch, $data->neckRubbing,  $data->torsoBending, $data->leftrightTR, $data->trunkTurn, $data->bothArms, $data->palmTouch, $data->clenchedFist, $data->pointing, $data->handsOnWaist, $data->handPalmout, $data->palmshake, $data->slouched, $data->legsMove, $data->legsFidget, $data->fidgeting, $data->others);
                    $stmt->execute();

                } else {

                    foreach($data->valvid as $row){

                        $stmt = $conn->prepare("INSERT INTO annotation VALUES (?,?,?,?,?,NULL);");
                        $stmt->bind_param("sssss", $row->timeStamp, $userId, $video, $type, $row->value);
                        $stmt->execute();
                    }
                }

                mysqli_close($conn);

            } else {
               $video = str_replace('.', '_', $video);

                if (!file_exists("annotation/".$userId."/".$video)) {
                    mkdir("annotation/".$userId."/".$video, 0777, true);
                }
                
                $myfile = fopen("annotation/".$userId."/".$video."/".$type.".csv", "w");

                if (!$myfile) {
                    header('HTTP/1.0 403 Forbidden');
                    die("Unable to open file!");
                }

                if (strpos($type, 'behavior') !== false){

                    fwrite($myfile,"UserId;NameVideo;AnnoType;faceTouch;neckRubbing;torsoBending;leftrightTR;trunkTurn;bothArms;palmTouch;clenchedFist;pointing;handsOnWaist;handPalmout;palmshake;slouched;legsMove;legsFidget;fidgeting;Others\n");
                    fwrite($myfile, $userId.";".$video.";".$type.";".$data->faceTouch.";".$data->neckRubbing .";".$data->torsoBending.";".$data->leftrightTR.";".$data->trunkTurn.";".$data->bothArms.";".$data->palmTouch.";".$data->clenchedFist.";".$data->pointing.";".$data->handsOnWaist.";".$data->handPalmout.";".$data->palmshake.";".$data->slouched.";".$data->legsMove.";".$data->legsFidget.";".$data->fidgeting.";".$data->others."\n");

                } else {

                    fwrite($myfile,"TimeStamp;UserId;NameVideo;AnnoType;Value\n");
                    
                    foreach($data->valvid as $row){
                        fwrite($myfile, $row->timeStamp.";".$userId.";".$video.";".$type.";".$row->value."\n");
                    }
                }
            }
        }