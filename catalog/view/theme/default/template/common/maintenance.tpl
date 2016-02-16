<!DOCTYPE html>
<html lang="en" >

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0" />
    <title><?php echo $heading_title; ?></title>
    <link rel="stylesheet" type="text/css" href="/catalog/view/theme/default/stylesheet/fontello.css">
    <!-- <link href='https://fonts.googleapis.com/css?family=Quattrocento+Sans' rel='stylesheet' type='text/css'> -->
    <style>
      html {
        height: 100%;
      }
      body {
        font-family: 'Helvetica', sans-serif;
        /*background-color: #37BCCF;*/
        height: 100%;
        margin: 0;
        padding: 0;
        background: #37bccf; /* Old browsers */
        background: -moz-linear-gradient(top, #37bccf 0%, #137e93 100%); /* FF3.6-15 */
        background: -webkit-linear-gradient(top, #37bccf 0%,#137e93 100%); /* Chrome10-25,Safari5.1-6 */
        background: linear-gradient(to bottom, #37bccf 0%,#137e93 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
      }
      * {
        color: #071139;
      }
      a {
        color: black;
      }
      #table-container {
        width: 100%;
        height: 100%;
      }
      #table-container > tr td {
        text-align: center;
      }
      #table-content {
        width: 80%;
      }

      #icon {
        font-size: 100px;
        margin-bottom: 30px;
      }
      h1 {
        color: white;
        margin: 0;
        /*text-transform: uppercase;*/
      }
      p {
        line-height: 1.5em;
        max-width: 500px;
        margin-bottom: 50px;
      }
      p span {
        white-space: nowrap;
      }
      ul {
        list-style: none;
        margin: 0 0 30px;
        padding: 0;
        text-align: center;
      }
      ul li {
        display: inline;
        font-size: 12px;
        padding: 0 10px;
      }
      @media (max-width: 740px) {

        p span {
          white-space: normal;
        }
      }
      @media (max-width: 480px) {

        #table-content tr td {
          padding: 0 5%;
        }
        #table-content tr td img {
          max-height: 100px;
          width: auto;
        }
        #icon {
          font-size: 80px;
        }
        h1 {
          font-size: 20px;
          line-height: 1em;
        }
        p {
          font-size: 12px;
          margin-bottom: 30px;
        }
        p span {
          white-space: normal;
        }
        p span:nth-of-type(n+2) {
          white-space: nowrap;
        }
        ul li {
          display: block;
          margin: 0 0 5px;
        }
      }
    </style>
  </head>

  <body class="maintenance-page">

    <table id="table-container" cellpadding="0" cellspacing="0" border="0">
      <tr>
        <td align="center">

          <table id="table-content" cellpadding="0" cellspacing="0" border="0" >
            <tr>
              <td valign="middle" align="center">

                <div id="icon"><i class="icon-traffic-cone"></i></div>
                <h1><?php echo $heading_title ;?></h1>
                <p><?php echo $message ;?></p>
              </td>
            </tr>
            <tr>
              <td>
                <ul>
                  <li>Phone: <a href="tel:<?php echo $this->config->get('config_telephone') ;?>"><?php echo $this->config->get('config_telephone') ;?></a></li>
                  <li>Email: <a href="mailto:<?php echo $this->config->get('config_email') ;?>"><?php echo $this->config->get('config_email') ;?></a></li>
                </ul>
              </td>
            </tr>

          </table>

        </td>
      </tr>
    </table>

  </body>

</html>
