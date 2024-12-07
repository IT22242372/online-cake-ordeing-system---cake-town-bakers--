<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            overflow: hidden;
        }

        .table_container {
            margin: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            font-size: 28px;
            color: #1c76db;
            margin-bottom: 5px;
        }

        .header p {
            font-size: 18px;
            color: #666;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th, table td {
            border: 1px solid #000000;
            padding: 12px;
            text-align: center;
        }

        table th {
            background-color: #1c76db;
            color: #ffffff;
        }

        table td {
            background-color: #f2f2f2;
        }

        .updateBtn {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
        }

        .add_new {
            padding: 10px 20px;
            color: #ffffff;
            background-color: #0298cf;
        }

        button {
            outline: none;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            padding: 10px;
            color: #ffffff;
        }

        .updateBtn:hover {
            background-color: #45a049;
        }

        .deleteBtn {
            background-color: #f44336;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
            margin-left: 5px;
        }

        .deleteBtn:hover {
            background-color: #e31e10;
        }

        @media print {
            body {
                margin: 0;
                padding: 0;
            }

            .print-area {
                display: block !important;
            }

            .table_section,
            .TableHeader {
                display: none;
            }

            .report {
                margin: 0;
            }

            .header h1 {
                font-size: 32px;
            }

            table {
                margin-top: 10px;
            }

            table th, table td {
                padding: 10px;
            }
        }
    </style>
<script>
    function printReport() {
        var reportContent = `
        <div class="header" style="text-align: center; margin-bottom: 20px;">
            <h1 style="margin: 0;">CakeTown Bakers</h1>
            <p style="margin: 5px 0;">Contact: 0112789654</p>
            <p style="margin: 5px 0;">Address: 2nd Lane, Malabe</p>
            <h2 style="margin-top: 20px;">Order Report</h2>
        </div>
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr>
                    <th style="border: 1px solid #000; padding: 8px;">Name</th>
                    <th style="border: 1px solid #000; padding: 8px;">Contact</th>
                    <th style="border: 1px solid #000; padding: 8px;">Address</th>
                    <th style="border: 1px solid #000; padding: 8px;">Item</th>
                    <th style="border: 1px solid #000; padding: 8px;">Quantity</th>
                    <th style="border: 1px solid #000; padding: 8px;">Total Price</th>
                </tr>
            </thead>
            <tbody>`;

        var tableRows = document.querySelectorAll('.table_section tbody tr');
        tableRows.forEach(function(row) {
            var name = row.cells[0].innerText;
            var mobile = row.cells[3].innerText; 
            var address = row.cells[2].innerText;
            var item = row.cells[7].innerText; 
            var quantity = row.cells[8].innerText; 
            var totalPrice = row.cells[9].innerText; 

            reportContent += `
            <tr>
                <td>${name}</td>
                <td>${mobile}</td>
                <td>${address}</td>
                <td>${item}</td>
                <td>${quantity}</td>
                <td>${totalPrice}</td>
            </tr>`;
        });
        
        reportContent += `
            </tbody>
        </table>

        <div class="signature" style="text-align: right; margin-top: 50px;">
            <p>_________________________</p>
            <p>Signature</p>
        </div>

        <div class="date" style="text-align: left; margin-top: 10px;">
            <p>Date: ${new Date().toLocaleDateString()}</p>
        </div>`;

        var newWindow = window.open('', '', 'width=800,height=600');
        newWindow.document.write('<html><head><title>Order Report</title>');
        newWindow.document.write('<style>' + document.querySelector('style').innerHTML + '</style>');
        newWindow.document.write('</head><body>' + reportContent + '</body></html>');
        newWindow.document.close();
        newWindow.print();
    }
</script>
</head>
<body>
    <div class="table_container">
        <div class="TableHeader">
            <h1>Order Details</h1>
            <br>
            <div>
                <a href="./admin.php"><button class="add_new">Admin Dashboard</button></a>
                <button onclick="printReport()" class="add_new">Print Report</button>
            </div>
        </div>

        <div class="table_section">
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>E-mail</th>
                        <th>Address</th>
                        <th>Mobile</th>
                        <th>Postal Code</th>
                        <th>Card Type</th>
                        <th>Exp Date</th>
                        <th>Item</th>
                        <th>Quantity</th>
                        <th>Total Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    include 'Config.php';
                    $sql = "SELECT * FROM `orders`";
                    $result = mysqli_query($conn, $sql);
                    if ($result) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $id = $row['id'];
                            $name = $row['name'];
                            $email = $row['email'];
                            $address = $row['address'];
                            $mobile = $row['mobile'];
                            $postal_code = $row['postalCode'];
                            $card_type = $row['cardType'];
                            $exp_date = $row['expDate'];
                            $item = $row['item'];
                            $quantity = $row['quantity']; 
                            $totalprice = $row['totalprice'];

                            echo '
                            <tr>
                                <td>' . $name . '</td>
                                <td>' . $email . '</td>
                                <td>' . $address . '</td>
                                <td>' . $mobile . '</td>
                                <td>' . $postal_code . '</td>
                                <td>' . $card_type . '</td>
                                <td>' . $exp_date . '</td>
                                <td>' . $item . '</td>
                                <td>' . $quantity . '</td>
                                <td>' . $totalprice . '</td>
                                <td>
                                    <a href="checkoutUpdate.php?updateid=' . $id . '"><button class="updateBtn">Update</button></a>
                                    <a href="checkoutDelete.php?deleteid=' . $id . '"><button class="deleteBtn">Delete</button></a>
                                </td>
                            </tr>';
                        }
                    }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
