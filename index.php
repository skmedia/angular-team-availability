<!doctype html>
<html ng-app="app">
    <head>
        <meta charset="utf-8">
        <title>Availability Sheet</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/bootstrap-responsive.css" rel="stylesheet">
        <link href="css/app.css" rel="stylesheet">

        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
          <script src="js/html5shiv.js"></script>
        <![endif]-->
        
    </head>

    <body>
        
        <div ng-view></div>
         
        <!-- Modal -->
        <div id="modalFormAvailability" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 id="myModalLabel">Log absence</h3>
            </div>
            <div class="modal-body">
                <form class="form-horizontal">
                    <div class="control-group">
                        <label class="control-label" for="date">Date</label>
                        <div class="controls">
                            <input type="text" id="date" placeholder="Date">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="hours">Hours</label>
                        <div class="controls">
                            <input type="text" id="hours" placeholder="Hours">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="absence_type_id">Absence Type</label>
                        <div class="controls">
                            <select>
                                <option>Select</option>
                                <option>Type 1</option>
                                <option>Type 2</option>
                                <option>Type 3</option>
                            </select>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="comment">Comment</label>
                        <div class="controls">
                            <textarea class="span3" type="comment" id="comment" placeholder="Comments"></textarea>
                        </div>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                <button class="btn btn-primary">Save changes</button>
            </div>
        </div>
        
        <script src="http://code.angularjs.org/1.0.6/angular.min.js"></script>
        <script src="js/moment.js"></script>
        <script src="js/moment-range.js"></script>
        <script src="js/app/app.js"></script>
        <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
        <script src="js/bootstrap.js"></script>
    </body>
</html>
