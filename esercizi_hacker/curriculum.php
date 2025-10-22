<?php
require_once("../lib/head.html");
$abilities = ["ciaooo", "ciaooo"];
error_reporting(0);
    ?>

<body class="bg-dark text-light">
    <?php
    require_once("../lib/header.php");
    require_once("../lib/back.htm");
    ?>
    <div class="d-flex my-auto justify-content-center">

        <form class="align-items-center g-3 needs-validation" novalidate method="post"
            action="<?php basename($_SERVER['SCRIPT_FILENAME']) ?>" name="form_hacker">
            <div class="mb-3">
                <div class="form-floating">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
                    <label for="name">Hacker's Name</label>
                    <div class="invalid-feedback">Please enter a name.</div>
                </div>
            </div>
            <div class="mb-3">

                <label for="power" class="form-label">Hacker's Power</label>
                <input type="range" class="form-range" min="1" max="10" id="power" name="power" required>
                <output for="power" id="powerValue" aria-hidden="true"></output>
                <div class="invalid-feedback">Please enter a valid value from 1 to 10.</div>

                <script>
                    const rangeInput = document.getElementById('power');
                    const rangeOutput = document.getElementById('powerValue');

                    // Set initial value
                    rangeOutput.textContent = rangeInput.value;

                    rangeInput.addEventListener('input', function () {
                        rangeOutput.textContent = this.value;
                    });
                </script>
            </div>
            <div class="mb-3">
                <label class="form-label">Abilities</label>
                <?php
                $types = ["Crack passwords", "Bypass firewalls", "Write useless and overcomplicated code", "Intall linux evrywhere"];
                foreach ($types as $type) {
                    $id = strtolower(str_replace(' ', '', $type));
                    echo ('
                        <div class="form-check form-switch">
                            <input class="form-check-input" value="true" type="checkbox" role="switch" id="' . $id . '" name="' . $id . '" >
                            <label class="form-check-label" for="' . $id . '">' . $type . '</label>
                        </div>
                    ');
                }
                ?>
            </div>
            <div class="mb-3 w-100 d-flex flex-column align-items-center">
                <label class="form-label">Favourite OS</label>
                <div class="d-flex justify-content-center w-100">
                    <input type="radio" class="btn-check m-2" name="os" id="os-linux" value="linux" autocomplete="off"
                        required>
                    <label class="btn btn-outline-primary mx-2" for="os-linux">Linux</label>

                    <input type="radio" class="btn-check m-2" name="os" id="os-macos" value="macos" autocomplete="off"
                        required>
                    <label class="btn btn-outline-primary mx-2" for="os-macos">macOS</label>

                    <input type="radio" class="btn-check m-2" name="os" id="os-windows" value="windows"
                        autocomplete="off" required>
                    <label class="btn btn-outline-primary mx-2" for="os-windows">Winblee</label>
                </div>
                <div class="invalid-feedback">Please select an OS.</div>
            </div>
            <div class="w-100">
                <button class="btn btn-primary w-100" type="submit" name="submit-curriculum">Send Curriculum</button>
            </div>
        </form>
        <script>
            // Example starter JavaScript for disabling form submissions if there are invalid fields
            (() => {
                'use strict'

                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                const forms = document.querySelectorAll('.needs-validation')

                // Loop over them and prevent submission
                Array.from(forms).forEach(form => {
                    form.addEventListener('submit', event => {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }

                        form.classList.add('was-validated')
                    }, false)
                })
            })()
        </script>
    </div>

    <?php
    if (isset($_POST['submit-curriculum'])) {
        $descrizioniHacker = [
            "Cracked the neighbor's WiFi just to slow it down.",
            "Speaks fluent binary, even in his sleep.",
            "Once hacked a microwave to run Doom on it.",
            "Writes code faster than you can read.",
            "Installed Linux on the coffee machine too.",
            "The dark web calls him for security advice.",
            "Compiles the kernel for sport.",
            "Doesn't format, rewrites the filesystem by hand.",
            "Caught a virus just to study it better.",
            "Rooted his friend's phone... remotely.",
            "Once made a firewall cry.",
            "Writes Bash scripts while having breakfast.",
            "Jailbroke the microwave oven.",
            "Knows all the passwords... even the ones that don't exist yet.",
            "Doesn't use antivirus, he programs them.",
            "Antiviruses use him as a definition.",
            "Hacked time to have more hours to debug.",
            "Compiles code just by looking at it.",
            "CAPTCHAs greet him with respect.",
            "Doesn't need a mouse. Nor a keyboard.",
            "Has a server in the garage... that hosts other servers.",
            "His PC is afraid of him.",
            "Installed Arch Linux... with the power of thought.",
            "Mined cryptocurrencies with a calculator.",
            "His resume is written in assembly.",
            "Once sniffed packets from the smart fridge.",
            "Talks to AI, but the AI calls him 'master'.",
            "Replaced the BIOS with his own custom version.",
            "Can program in Brainfuck... to relax.",
            "Installed TOR on the fridge.",
            "Decrypted a ZIP file without a password... by intuition.",
            "Performed a DoS on himself, just to see what it felt like.",
            "Has a tattoo with the ASCII code for freedom.",
            "Writes his emails in hexadecimal.",
            "Doesn't browse, he penetrates packets.",
            "Designed his website in HTML using only notepad.",
            "Reverse-engineered a toaster.",
            "Knows what every active process does... even Windows ones.",
            "Wrote a virus that behaves better than some software.",
            "Hacked the BIOS... remotely.",
            "His WiFi has a VPN, inside another VPN.",
            "Compiles C code without errors on the first try.",
            "Has a RAID of Raspberry Pis under his bed.",
            "Uses GIT even for the shopping list.",
            "His keyboard has more wear on the ESC key than on the spacebar.",
            "Debugged a bug in the operating system... in a dream.",
            "Port-forwarded the neighbor's router.",
            "Used ChatGPT... before it was cool.",
            "Discovered a 0-day... as a hobby.",
            "Has a firewall inside a firewall, for security."
        ];

        //fetch info form:
        $Nome = $_POST['name'];
        $Power = $_POST['power'];
        // $Skills = ["crack password", "bypass firewall", "scrivere codice inutilmente complicato", "installare linux ovunque"];
        $Skills = ["Crack passwords", "Bypass firewalls", "Write useless and overcomplicated code", "Intall linux evrywhere"];

        $SelectedSkills = [];
        foreach ($Skills as $Skill) {
            if ($_POST[strtolower(str_replace(' ', '', $Skill))] == "true") {
                array_push($SelectedSkills, $Skill);
            }
        }

        $OS = [
            "linux" => "OS for the thugs",
            "macos" => "daddy's money",
            "windows" => "doesn't deserve to be here"
        ];
        $SelectedOSDesc;
        $SelectedOS;
        foreach ($OS as $name => $desc) {
            if ($_POST['os'] == $name) {
                $SelectedOSDesc = $desc;
                $SelectedOS = $name;
                break;
            }
        }

        $opsec = (int) rand() % 100 + 1;



        //     //print del form:
        //     echo ("nome" . $Nome . "<br>
        // power " . $Power . "<br>
        // skill scelte : ");
        //     //skill
        //     foreach ($SelectedSkills as $Skill) {
        //         echo ($Skill . "<br>");
        //     }
        //     //sistema operativo:
        //     echo ("Sistema operativo : " . $SelectedOS . " : " . $SelectedOSDesc . "<br>");
        //     //desc random :
        //     echo ("Descrizione: " .);
        //     //sicurezza:
        //     echo ("<br>Opsec: " . $opsec);
        echo ('<div class="mx-4 mt-2 d-flex my-auto justify-content-center ">');


        echo ('
        
        <div class="card border-success bg-success mb-3" style="max-width: 18rem;">
        <div class="card-header fw-bolder fs-4">' . $Nome . '</div>
        <div class="card-body">
            <ul class="list-group list-group-flush bg-primary">
                <li class="list-group-item"><b>Power:</b> ' . $Power . '</li>
                <li class="list-group-item"><b>Skills:</b>  ' . $SelectedSkills . '</li>
                <li class="list-group-item"><b>OS:</b>  ' . $SelectedOS . ", " . $SelectedOSDesc . '</li>
                <li class="list-group-item"><b>Description:</b>  ' . $descrizioniHacker[array_rand($descrizioniHacker)] . '</li>
                <li class="list-group-item"><b>OPSec:</b>  ' . $opsec . '</li>
            
                </ul>
        </div>
        </div>
        ');

        echo ('</div>');



    }



    ?>

</body>



</html>