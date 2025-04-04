<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <title>Surat Tanda Terima {{ $mail->name }}</title>
    <style>
      body {
        font-family: Arial, sans-serif;
        font-size: 12px;
        margin: 0;
        padding: 20px;
      }
      .container {
        max-width: 100%;
        margin: 0 auto;
      }
      table {
        width: 100%;
        border-collapse: collapse;
      }
      table tr td {
        padding: 2px 0;
        vertical-align: top;
      }
      table tr td:first-child {
        width: 120px;
      }
      table tr td:nth-child(2) {
        width: 10px;
        text-align: center;
      }
      .signature {
        text-align: right;
        margin-top: 20px;
      }
      .divider {
        border-bottom: 2px dashed black;
        margin: 20px 0;
      }
    </style>
  </head>
  <body>
    <div class="container">
      <table>
        <tr>
          <td>Nama</td>
          <td style="width: 30px; text-align: center;">:</td>
          <td>{{ $mail->name }}</td>
        </tr>
        <tr>
          <td>Perihal</td>
          <td style="width: 30px; text-align: center;">:</td>
          <td>{{ $mail->category->name }}</td>
        </tr>
        <tr>
          <td>Keterangan</td>
          <td style="width: 30px; text-align: center;">:</td>
          <td>{{ $mail->description }}</td>
        </tr>
        <tr>
          <td>Nomor Telepon</td>
          <td style="width: 30px; text-align: center;">:</td>
          <td>+62{{ $mail->phone_number }}</td>
        </tr>
        <tr>
          <td>Tanggal Masuk</td>
          <td style="width: 30px; text-align: center;">:</td>
          <td>{{ $receivedAt }}</td>
        </tr>
        <tr>
          <td>Nomor Surat</td>
          <td style="width: 30px; text-align: center;">:</td>
          <td>{{ $mail->reference_number }}</td>
        </tr>
        <tr>
          <td>Tanggal Surat</td>
          <td style="width: 30px; text-align: center;">:</td>
          <td>{{ $letterDate }}</td>
        </tr>
      </table>

      <div class="signature">
        <p>Sukoharjo, {{ $currentDate }}</p>
        <div style="height: 80px"></div>
        <p>(...........................)</p>
      </div>

      <div class="divider"></div>

      <table>
        <tr>
          <td>Nama</td>
          <td style="width: 30px; text-align: center;">:</td>
          <td>{{ $mail->name }}</td>
        </tr>
        <tr>
          <td>Perihal</td>
          <td style="width: 30px; text-align: center;">:</td>
          <td>{{ $mail->category->name }}</td>
        </tr>
        <tr>
          <td>Keterangan</td>
          <td style="width: 30px; text-align: center;">:</td>
          <td>{{ $mail->description }}</td>
        </tr>
        <tr>
          <td>Nomor Telepon</td>
          <td style="width: 30px; text-align: center;">:</td>
          <td>+62{{ $mail->phone_number }}</td>
        </tr>
        <tr>
          <td>Tanggal Masuk</td>
          <td style="width: 30px; text-align: center;">:</td>
          <td>{{ $receivedAt }}</td>
        </tr>
        <tr>
          <td>Nomor Surat</td>
          <td style="width: 30px; text-align: center;">:</td>
          <td>{{ $mail->reference_number }}</td>
        </tr>
        <tr>
          <td>Tanggal Surat</td>
          <td style="width: 30px; text-align: center;">:</td>
          <td>{{ $letterDate }}</td>
        </tr>
      </table>

      <div class="signature">
        <p>Sukoharjo, {{ $currentDate }}</p>
        <div style="height: 80px"></div>
        <p>(...........................)</p>
      </div>
    </div>
  </body>
</html>
