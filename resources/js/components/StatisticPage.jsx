import React from "react";
import ReactDOM from "react-dom/client";
import StatisticTable from "./StatisticTable";

export default function StatisticPage() {
    return (
        <div className="container">
            <div className="row justify-content-center">
                <div className="col-md-8">
                    <div className="card">
                        <div className="card-body">
                            <StatisticTable />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
}

const root = document.getElementById("statistic");
if (root) {
    ReactDOM.createRoot(root).render(<StatisticPage/>);
}
