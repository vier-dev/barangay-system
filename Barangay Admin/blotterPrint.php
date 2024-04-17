<?php
include './app/components/head.php';

?>

<link rel="stylesheet" href="./app/assets/css/blotterPrint.css">

<main class="container">

    <div class="body">
        <div class="buttons-container">
            <button type="button" id="back" name="back" class="btn btn-secondary">Back</button>
            <button type="button" id="print" name="print" class="btn btn-primary"><i class="fa fa-print px-1"></i>Print Document</button>
        </div>
        <div class="invoice-container">
            <table>
                <tr class="information">
                    <td>
                        <table>
                            <tr>
                                <td>
                                    <b>Republic of the Philippines</b><br>
                                    Province of Manila<br>
                                    Municipality of Caren<br>
                                    Barangay Poblacion Uno<br>
                                    Office of the Punong Barangay<br>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <tr class="heading">
                    <td>COMPLAINT LETTER</td>
                </tr>

                  <!--Date of Complain-->
                  <tr>
                    <td>Date of Complain : <input id="date_filed" readonly style="font-weight: 700; padding-bottom:20px; background-color:transparent;"> </td>
                </tr>

                <!--Complainant-->
                <tr>
                    <td> <input id="complainant" readonly style="font-weight: 700; background-color:transparent;"> </td>
                </tr>
                <tr>
                    <td><i>Complainant</i></td>
                </tr>
                <tr>
                    <td>
                        Barangay Poblacion Uno
                        <br>
                        <br>
                </tr>

                <!--Defendant-->
                <tr>
                    <td>
                        <input id="defendant" readonly style="font-weight: 700; background-color:transparent;">
                    </td>
                </tr>
                <tr>
                    <td><i>Defendant</i></td>
                </tr>
                <tr>
                    <td>
                        Barangay Poblacion Uno
                        <br>
                        <br>
                        <br>
                    </td>
                </tr>

                <!--Greetings-->
                <tr class="details">
                    <td>
                        Dear Mr/Ms. <input id="defendant_greetings" readonly style="font-weight: 700; width: 18%; background-color:transparent;"> ,
                    </td>
                </tr>


                <!--Document body-->
                <tr class="details">
                    <td>
                        I am writing to address a concerning b issue that has arisen between us, which I believe requires immediate attention and resolution.
                        On <input id="incident_date" readonly style="font-weight: 700; width: 12%; text-align:center; background-color:transparent;">, there was a
                        <input id="blotter_accusation" readonly style="font-weight: 700; width: 33%; text-align:center; background-color:transparent;">  occurred, which has greatly affected us in our end.
                        Despite my attempts to resolve the matter amicably, I regret to inform you that the situation has not been adequately addressed.

                    </td>
                </tr>

                <tr class="details">
                    <td>
                        As such, I am left with no choice but to formally bring this matter to your attention and request your cooperation in resolving it.
                        I kindly ask that you take immediate steps to rectify the situation and ensure that such incidents do not occur in the future.
                        It is imperative that we find a mutually acceptable resolution to this matter to avoid any further escalation.

                    </td>
                </tr>

                <tr class="details">
                    <td>
                        Please be advised that if the issue is not addressed in a timely and satisfactory manner, I will have no option but to seek further assistance from the appropriate authorities or legal channels.
                        I trust that you will take this matter seriously and act accordingly to resolve it as soon as possible.
                        Your cooperation in this regard is greatly appreciated.
                    </td>
                </tr>

                <tr class="details">
                    <td>
                        Thank you for your attention to this matter, and I look forward to your prompt response.
                    </td>
                </tr>


                <!--Complainant's name-->
                <tr class="details">
                    <td>Sincerely,</td>
                </tr>

                <tr>
                    <td> <input id="complainant_bottom" readonly style="font-weight: 700; background-color:transparent;"> </td>
                </tr>
                <tr>
                    <td><i>Complainant</i></td>
                </tr>
            </table>
        </div>
    </div>
</main>

<script src="./app/app.js"></script>
<script src="./app/object-js/print.js"></script>

<?php


?>