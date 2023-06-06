import React from "react";
import ReactDOM from "react-dom/client";
import ReportTable from "./ReportTable";
import ReportLine from "./ReportLine";
export default function ReportPage() {
    return (
        <div className="container">
            <div className="row justify-content-center">
                <div className="col-md-8">
                    <div className="card">
                        <div className="card-header"> Report Diagramm</div>

                        <div className="card-body">
                           <ReportLine/>
                        </div>
                    </div>
                    <div className="card">
                        <div className="card-header">Report Table</div>

                        <div className="card-body">
                           <ReportTable/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
}

const report_root = document.getElementById("report");
if (report_root) {
    ReactDOM.createRoot(report_root).render(<ReportPage />);
}
