<style>
    @media print {
        .print_body {
            padding-bottom: 120px;
            
        }
        .print_signature {
            justify-content: space-between;
            align-items: center;
            position: absolute;
            width: 100%;
            left: 0;
            bottom: 0;
            padding: 0 15px;
            min-height: 120px;
            display: flex !important;
        }
        .print_signature h4 {
            display: inline-block;
            color: #919191;
            margin: 0;
            padding: 5px 0;
            border-top: 2px dashed #919191;
        }
    }
</style>

<div class="container-fluid">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading panal-header">
                <div class="panal-header-title pull-left">
                    <h1>Purchase Invoice</h1>
                </div>
            </div>
            <div class="panel-body print_body">

                <div class="print_signature hide">
                    <div class="signature_box"></div>
                    <div class="signature_box">
                        <h4>Authority Signature</h4>
                    </div>
                </div>
            </div>
            <div class="panel-footer">&nbsp;</div>
        </div>
    </div>
</div>
