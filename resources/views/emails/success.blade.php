<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}- Success</title>
    <style type="text/css">
        @media only screen and (max-width: 600px) {
            table[class="contenttable"] {
                width: 320px !important;
                border-width: 3px !important;
            }

            table[class="tablefull"] {
                width: 100% !important;
            }

            table[class="tablefull"]+table[class="tablefull"] td {
                padding-top: 0px !important;
            }

            table td[class="tablepadding"] {
                padding: 15px !important;
            }
        }
    </style>
</head>

<body style="margin:0; border: none; background:#f5f7f8">
    <table align="center" border="0" cellpadding="0" cellspacing="0" height="100%" width="100%">
        <tr>
            <td align="center" valign="top">
                <table class="contenttable" border="0" cellpadding="0" cellspacing="0" width="600"
                    bgcolor="#ffffff"
                    style="border-width:1px; border-style: solid; border-collapse: separate; border-color:#ededed; margin-top:20px; font-family:Arial, Helvetica, sans-serif">
                    <tr>
                        <td>
                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tbody>
                                    <tr>
                                        <td width="100%" height="30">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td valign="top" align="center"><a href="#"><img alt=""
                                                    src="logo.png"
                                                    style="padding-bottom: 0; display: inline !important;"></a></td>
                                    </tr>
                                    <tr>
                                        <td width="100%" height="30">&nbsp;</td>
                                    </tr>
                                    <tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:0px 20px;">
                            <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                <tbody>
                                    <tr>
                                        <td style="border:4px solid #eee; border-radius:4px; padding:25px 0px;">
                                            <table width="100%" cellspacing="0" cellpadding="0" border="0"
                                                align="center">
                                                <tbody>
                                                    <tr>
                                                        <td style="font-size:14px; padding:0px 25px;" width="50">
                                                            <img alt="{{ asset('frontend/email-template/bus-email-template/booking-successful.png') }}"
                                                                src="">
                                                        </td>
                                                        <td
                                                            style="font-size:16px; font-weight:600; color:#777; line-height:26px; padding-right:20px;">
                                                            <span style="font-size:13px;">Hi
                                                                {{ $order->user->name }},</span><br>
                                                            Selamat booking tiket Anda <span
                                                                style="color:#28a745;">berhasil</span>.
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td class="tablepadding" style="border-bottom:1px solid #e9e9e9;padding:20px 20px;">
                            <table width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
                                <tbody>
                                    <tr>
                                        @if ($order->schedule->route == 'ML')
                                            <td valign="top" width="35%" style="font-size:14px; line-height:20px;">
                                                <span style="color:#909090">Dari:</span><br>
                                                Medan
                                            </td>
                                            <td valign="top" width="35%" style="font-size:14px; line-height:20px;">
                                                <span style="color:#909090">Ke:</span><br>
                                                Laguboti
                                            </td>
                                            <td valign="top" width="30%" style="font-size:14px; line-height:20px;">
                                                <span style="color:#909090">Tanggal Pergi:</span><br>
                                                {{ $order->schedule->date }}
                                            </td>
                                        @elseif ($order->schedule->route == 'LM')
                                            <td valign="top" width="35%" style="font-size:14px; line-height:20px;">
                                                <span style="color:#909090">Dari:</span><br>
                                                Laguboti
                                            </td>
                                            <td valign="top" width="35%" style="font-size:14px; line-height:20px;">
                                                <span style="color:#909090">Ke:</span><br>
                                                Medan
                                            </td>
                                            <td valign="top" width="30%" style="font-size:14px; line-height:20px;">
                                                <span style="color:#909090">Tanggal Pulang:</span><br>
                                                {{ $order->schedule->date }}
                                            </td>
                                        @elseif ($order->schedule->route == 'SL')
                                            <td valign="top" width="35%" style="font-size:14px; line-height:20px;">
                                                <span style="color:#909090">Dari:</span><br>
                                                Sibolga
                                            </td>
                                            <td valign="top" width="35%" style="font-size:14px; line-height:20px;">
                                                <span style="color:#909090">Ke:</span><br>
                                                Laguboti
                                            </td>
                                            <td valign="top" width="30%" style="font-size:14px; line-height:20px;">
                                                <span style="color:#909090">Tanggal Pergi:</span><br>
                                                {{ $order->schedule->date }}
                                            </td>
                                        @elseif ($order->schedule->route == 'LS')
                                            <td valign="top" width="35%"
                                                style="font-size:14px; line-height:20px;">
                                                <span style="color:#909090">Dari:</span><br>
                                                Laguboti
                                            </td>
                                            <td valign="top" width="35%"
                                                style="font-size:14px; line-height:20px;">
                                                <span style="color:#909090">Ke:</span><br>
                                                Sibolga
                                            </td>
                                            <td valign="top" width="30%"
                                                style="font-size:14px; line-height:20px;">
                                                <span style="color:#909090">Tanggal Pulang:</span><br>
                                                {{ $order->schedule->date }}
                                            </td>
                                        @endif
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td class="tablepadding" style="border-bottom:1px solid #e9e9e9;padding:20px 20px;">
                            <table width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
                                <tbody>
                                    <tr>
                                        <td valign="top" width="35%" style="font-size:14px; line-height:20px;">
                                            <span style="color:#909090">Jam Pelaporan:</span><br>
                                            6:50 Malam
                                        </td>
                                        <td valign="top" width="35%" style="font-size:14px; line-height:20px;">
                                            <span style="color:#909090">Jam Keberangkatan:</span><br>
                                            7:00 Malam
                                        </td>
                                        <td valign="top" width="30%" style="font-size:14px; line-height:20px;">
                                            <span style="color:#909090">Ticket ID</span><br>
                                            {{ $order->code }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td class="tablepadding" style="border-bottom:1px solid #e9e9e9;padding:20px 20px;">
                            <table width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
                                <tbody>
                                    <tr>
                                        <td valign="top" width="35%" style="font-size:14px; line-height:20px;">
                                            <span style="color:#909090">Nama Penumpang:</span><br>
                                            {{ $order->user->name }}
                                        </td>
                                        <td valign="top" width="35%" style="font-size:14px; line-height:20px;">
                                            <span style="color:#909090">Nomor Bangku:</span><br>
                                            @foreach ($order->orderDetails as $item)
                                                {{ $item->seat_id }}
                                            @endforeach
                                        </td>
                                        <td valign="top" width="30%" style="font-size:14px; line-height:20px;">
                                            <span style="color:#909090">Travels</span><br>
                                            Koperasi Bintang Laguboti
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:20px;">
                            <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                <tbody>
                                    <tr>
                                        <td style="background-color:#efefef; border-radius:4px; padding:25px 20px;">
                                            <table width="100%" cellspacing="0" cellpadding="0" border="0"
                                                align="center">
                                                <tbody>
                                                    <tr>
                                                        <td
                                                            style="font-size:15px; line-height:20px; color:#404040; font-weight: bold;">
                                                            Total Harga:</td>
                                                        <td style="font-size:16px; line-height:20px; color: #404040; font-weight: bold;"
                                                            valign="top" align="right">Rp.
                                                            {{ number_format($order->total, 0, ',', '.') }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td align="center"
                            style="font-size:14px; line-height:22px; padding:10px 20px 30px; color:#808080;">
                            **Selalu bawa tiket anda.</td>
                    </tr>
                    <tr>
                        <td>
                            <table width="100%" cellspacing="0" cellpadding="0" border="0"
                                style="font-size:13px;color:#555555; font-family:Arial, Helvetica, sans-serif;">
                                <tbody>
                                    <tr>
                                        <td class="tablepadding" align="center"
                                            style="font-size:14px; line-height:32px; padding:34px 20px; border-top:1px solid #e9e9e9;">
                                            Punya pertanyaan? Silahkan hubungi kami.<br />
                                        </td>
                                    </tr>
                                    <tr> </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>
