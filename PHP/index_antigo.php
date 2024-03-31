<?php  error_reporting(0);


include "funcoes.php";

?>
<link href="bootstrap.min.css" rel="stylesheet">

<div class="container d-flex justify-content-center align-items-center p-5">
    <div class="card p-4 w-75">
        <div class="card-body">
            <h1 class="mb-4">Conversor de Cores</h1>
            <form method="post">
                <div class="mb-3">
                    <label for="conversao" class="form-label">Selecione uma conversão:</label>
                    <select class="form-select" id="conversao" onchange="submit()" name="conversao">
                        <option value="normalize" <?php if ($_POST['conversao'] == "normalize") print "selected"; ?>>Normalizar RGB</option>
                        <option value="rgbToHsv" <?php if ($_POST['conversao'] == "rgbToHsv") print "selected"; ?>>RGB para HSV</option>
                        <option value="hsvToRgb" <?php if ($_POST['conversao'] == "hsvToRgb") print "selected"; ?>>HSV para RGB</option>
                        <option value="rgbToCmyk" <?php if ($_POST['conversao'] == "rgbToCmyk") print "selected"; ?>>RGB para CMYK</option>
                        <option value="cmykToRgb" <?php if ($_POST['conversao'] == "cmykToRgb") print "selected"; ?>>CMYK para RGB</option>
                        <option value="grayScale" <?php if ($_POST['conversao'] == "grayScale") print "selected"; ?>>RGB para Escala de Cinza</option>
                    </select>
                </div>
                <?php
                if ($_POST) {
                    if ($_POST['conversao'] != "") {
                        $conversao = $_POST['conversao'];

                        if ($conversao == 'normalize' or $conversao == 'grayScale' or $conversao == "rgbToHsv" or $conversao == "rgbToCmyk") { ?>
                            <div class="mb-3">
                                <label for="red" class="form-label">Red (0-255):</label>
                                <input type="number" class="form-control" id="red" name="red" min="0" max="255" required value="<?php print $_POST['red'] ?>">
                            </div>
                            <div class="mb-3">
                                <label for="green" class="form-label">Green (0-255):</label>
                                <input type="number" class="form-control" id="green" name="green" min="0" max="255" required value="<?php print $_POST['green'] ?>">
                            </div>
                            <div class="mb-3">
                                <label for="blue" class="form-label">Blue (0-255):</label>
                                <input type="number" class="form-control" id="blue" name="blue" min="0" max="255" required value="<?php print $_POST['blue'] ?>">
                            </div> <?php

                                    if ($_POST['red'] != "" and $_POST['green'] != "" and $_POST['blue'] != "") {

                                        $red = $_POST['red'];
                                        $green = $_POST['green'];
                                        $blue = $_POST['blue'];

                                        $valFuncao = $_POST['conversao']($red, $green, $blue);

                                        $hex = end($valFuncao);
                                    }

                                    if ($conversao == "normalize") { ?>
                                <div class="mb-3">
                                    <label for="normalizado" class="form-label">RGB Normalizado:</label>
                                    <input type="text" class="form-control" disabled value="<?php print $valFuncao[0] . "," . $valFuncao[1] . "," . $valFuncao[2] ?> ">
                                </div>
                            <?php
                                    } elseif ($conversao == "grayScale") { ?>
                                <div class="mb-3">
                                    <label for="normalizado" class="form-label">Escala de Cinza:</label>
                                    <input type="text" class="form-control" disabled value="<?php print $valFuncao[0] ?> ">
                                </div>
                            <?php
                                    } elseif ($conversao == "rgbToHsv") { ?>
                                <div class="mb-3">
                                    <label for="normalizado" class="form-label">Hue:</label>
                                    <input type="text" class="form-control" disabled value="<?php print $valFuncao[0] ?> &ordm;">
                                </div>
                                <div class="mb-3">
                                    <label for="normalizado" class="form-label">Saturation:</label>
                                    <input type="text" class="form-control" disabled value="<?php print $valFuncao[1] ?> %">
                                </div>
                                <div class="mb-3">
                                    <label for="normalizado" class="form-label">Value:</label>
                                    <input type="text" class="form-control" disabled value="<?php print $valFuncao[2] ?> %">
                                </div>
                            <?php
                                    } else { ?>
                                <div class="mb-3">
                                    <label for="normalizado" class="form-label">Cyan:</label>
                                    <input type="text" class="form-control" disabled value="<?php print $valFuncao[0] ?> %">
                                </div>
                                <div class="mb-3">
                                    <label for="normalizado" class="form-label">Magenta:</label>
                                    <input type="text" class="form-control" disabled value="<?php print $valFuncao[1] ?> %">
                                </div>
                                <div class="mb-3">
                                    <label for="normalizado" class="form-label">Yellow:</label>
                                    <input type="text" class="form-control" disabled value="<?php print $valFuncao[2] ?> %">
                                </div>
                                <div class="mb-3">
                                    <label for="normalizado" class="form-label">Key:</label>
                                    <input type="text" class="form-control" disabled value="<?php print $valFuncao[3] ?> %">
                                </div>


                            <?php
                                    }
                                } else if ($conversao == "hsvToRgb") { ?>

                            <div class="mb-3">
                                <label for="red" class="form-label">Hue (0-360)&ordm;:</label>
                                <input type="number" class="form-control" id="hue" name="hue" min="0" max="360" required value="<?php print $_POST['hue'] ?>">
                            </div>
                            <div class="mb-3">
                                <label for="green" class="form-label">Saturation (0-100)%:</label>
                                <input type="number" class="form-control" id="saturation" name="saturation" min="0" max="100" required value="<?php print $_POST['saturation'] ?>">
                            </div>
                            <div class="mb-3">
                                <label for="blue" class="form-label">Value (0-100)%:</label>
                                <input type="number" class="form-control" id="value" name="value" min="0" max="100" required value="<?php print $_POST['value'] ?>">
                            </div>
                            <?php
                                    if ($_POST['hue'] != "" and $_POST['saturation'] != "" and $_POST['value'] != "") {

                                        $hue = $_POST['hue'];
                                        $saturation = $_POST['saturation'];
                                        $value = $_POST['value'];

                                        $valFuncao = $_POST['conversao']($hue, $saturation, $value);

                                        if ($valFuncao == array()) { ?>
                                    <div class="mb-3">
                                        Valores Inválidos
                                    </div>

                                <?php
                                        } else {



                                            $hex = end($valFuncao);

                                ?>
                                    <div class="mb-3">
                                        <label for="red" class="form-label">Red:</label>
                                        <input type="number" class="form-control" id="red" name="red" min="0" max="255" disabled value="<?php print  $valFuncao[0] ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label for="green" class="form-label">Green:</label>
                                        <input type="number" class="form-control" id="green" name="green" min="0" max="255" disabled value="<?php print $valFuncao[1] ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label for="blue" class="form-label">Blue:</label>
                                        <input type="number" class="form-control" id="blue" name="blue" min="0" max="255" disabled value="<?php print $valFuncao[2] ?>">
                                    </div>

                            <?php
                                        }
                                    }
                                } else { ?>
                            <div class="mb-3">
                                <label for="red" class="form-label">Cyan (0-100)%:</label>
                                <input type="number" class="form-control" id="cyan" name="cyan" min="0" max="360" required value="<?php print $_POST['cyan'] ?>">
                            </div>
                            <div class="mb-3">
                                <label for="green" class="form-label">Magenta (0-100)%:</label>
                                <input type="number" class="form-control" id="magenta" name="magenta" min="0" max="100" required value="<?php print $_POST['magenta'] ?>">
                            </div>
                            <div class="mb-3">
                                <label for="blue" class="form-label">Yellow (0-100)%:</label>
                                <input type="number" class="form-control" id="yellow" name="yellow" min="0" max="100" required value="<?php print $_POST['yellow'] ?>">
                            </div>
                            <div class="mb-3">
                                <label for="blue" class="form-label">Key (0-100)%:</label>
                                <input type="number" class="form-control" id="key" name="key" min="0" max="100" required value="<?php print $_POST['key'] ?>">
                            </div>
                            <?php
                                    if ($_POST['cyan'] != "" and $_POST['magenta'] != "" and $_POST['yellow'] != "" and $_POST['key'] != "") {

                                        $cyan = $_POST['cyan'];
                                        $magenta = $_POST['magenta'];
                                        $yellow = $_POST['yellow'];
                                        $key = $_POST['key'];

                                        $valFuncao = $_POST['conversao']($cyan, $magenta, $yellow, $key);

                                        $hex = end($valFuncao);       ?>
                                <div class="mb-3">
                                    <label for="red" class="form-label">Red:</label>
                                    <input type="number" class="form-control" id="red" name="red" min="0" max="255" disabled value="<?php print  $valFuncao[0] ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="green" class="form-label">Green:</label>
                                    <input type="number" class="form-control" id="green" name="green" min="0" max="255" disabled value="<?php print $valFuncao[1] ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="blue" class="form-label">Blue:</label>
                                    <input type="number" class="form-control" id="blue" name="blue" min="0" max="255" disabled value="<?php print $valFuncao[2] ?>">
                                </div>

                        <?php
                                    }
                                }
                            }


                            if ($hex != "") {
                        ?>


                        <div class="mb-3">
                            <label for="color-preview" class="form-label">Pré-visualização da Cor:</label>
                            <input type="color" class="form-control form-control-color" id="color-preview" name="color-preview" value="<?php print $hex ?>" disabled style='width:250px; height:250px;'>
                        </div>
                <?php  }
                        }



                ?>
                <div class="row justify-content-end">
                    <div class="col-md-3 text-end">
                        <button type="submit" class="btn btn-primary">Converter</button>
                    </div>
                </div>
        </div>
        </form>
    </div>
</div>