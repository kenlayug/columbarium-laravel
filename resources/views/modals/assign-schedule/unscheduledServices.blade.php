<div id="sched" class="modal modal-fixed-footer" style="width:95%; max-height: 120%;">
    <div class="modal-header" style="background-color: #00897b;">
        <h5 style = "color: white; text-align: center; font-size: 20px; padding: 20px; margin-top: 0px;">Aaron Clyde Garil: Pre-Need Services</h5>
        <a tooltipped class="btn-floating modal-close btn-flat btn teal" data-position="top" data-delay="50" data-tooltip="Close"
            style="position:absolute;top:0;right:0; z-index: 1000; margin-top: 10px; margin-right: 10px; color: white; font-weight: 900;">X</a>
    </div>

    <div id="admin" class="modal-content" style="overflow-y: auto">
        <div class="z-depth-2 card material-table" style="margin-left: 10px; margin-right: 10px;">
            <table id="datatable2">
                <thead>
                <tr>
                    <th class="center" style="font-size: 16px;">Package Name</th>
                    <th class="center" style="font-size: 16px;">Additional/Service Name</th>
                    <th class="center" style="font-size: 16px;">Action</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="center">Senior's Cremation</td>
                    <td class="center">Cremation</td>
                    <td class="center">
                        <button class="waves-light btn light-green" style="color: #000000;">Claim</button>
                        <button class="btn-floating waves-light btn red modal-trigger" data-target="scheduleService" tooltipped 
                                href="#scheduleService" data-position="bottom" data-delay="30" data-tooltip="Schedule Service">
                                <i class="material-icons" style="color: #000000">schedule</i></button>
                        <button class="btn-floating waves-light btn red modal-trigger" data-target="scheduleService" tooltipped 
                                href="#deceasedForm" data-position="bottom" data-delay="30" data-tooltip="Assign Deceased">
                                <i class="material-icons" style="color: #000000">assignment_ind</i></button>
                        <a class="btn-floating waves-light btn red"  tooltipped data-position="bottom" data-delay="30" data-tooltip="Remove Service">
                                <i class="material-icons" style="color: #000000">not_interested</i></a></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="modal-footer">
        <label style="color: #00897b; font-size: 20px; margin-left: 15px;">LEGEND:</label>
        <button name = "action" class="btn-floating green" style="margin-left: 15px;"></button>
        <label style="font-size: 15px; color: #000000; font-size: 18px; margin-left: 5px;">Configured</label>
        <button name = "action" class="btn-floating red" style="margin-left: 15px;"></button>
        <label style="font-size: 15px; color: #000000; font-size: 18px; margin-left: 5px;">Not Configured</label>
    </div>
</div>