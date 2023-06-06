import { get } from "lodash";
import React, { useState, useEffect } from "react";
import { Chart } from "react-google-charts";

export default function ReportTable() {
    const [data, setDataLine] = useState([]);
    useEffect(() => {
        getDataLine();
    }, []);
    const getDataLine = async () => {
        const response = await fetch(
            `/api/report`,
            { method: "GET" }
        );

        setDataLine(await response.json());
    };

    const options = {
      title: "Company Performance",
      curveType: "function",
      legend: { position: "bottom" },
      pageSize: 15,
    };

        return (
          <Chart
          chartType="Table"
          width="100%"
          height="400px"
          data={data}
          options={options}
        />
        );


}