<!-- Modal Requirements -->
<div id="modalRequirement" class="modalRequirement modal modal-fixed-footer">
    <div class = "modal-header">
        <h4 class = "listOfReqH4">List of Requirement/s</h4>
        <a class="btn-floating modal-close btn-flat btn teal tooltipped" data-position="top" data-delay="50" data-tooltip="Close"
           style="position:absolute;top:0;right:0; z-index: 1000; margin-top: 10px; margin-right: 10px; color: white; font-weight: 900;">&#10006;
        </a>
    </div>
    <div class="modal-content">
        <div class = "col s12">
            <br>
            <div class="row">
                <div class = "col s6">
                    <p ng-repeat="requirement in requirementList">
                        <input type="checkbox" id="@{{ requirement.intRequirementId }}" name="requirement[]" value="@{{ requirement.intRequirementId }}" />
                        <label for="@{{ requirement.intRequirementId }}">@{{ requirement.strRequirementName }}</label>
                    </p>
                </div>

                <div class = "col s6">

                </div>
            </div>
        </div>
        <br><br><br><br><br><br><br><br><br><br><br><br>

        <div class="modal-footer" style = "width: 575px;">
            <button onclick="$('#modalRequirement').closeModal()" name = "action" class="btn light-green right" style = "color: black;">CONFIRM</button>
            <button name = "action" class="waves-effect waves-light modal-close btn light-green" style = "color: black; margin-right: 10px;">Cancel</button>
        </div>
    </div>
</div>