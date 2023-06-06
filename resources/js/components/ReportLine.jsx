import { get } from "lodash";
import React, { useState, useEffect } from "react";
import { Chart } from "react-google-charts";

export default function ReportLine() {
    const [dataLine, setDataLine] = useState([]);
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
        chart: {
          title: "Graphs of event dependence on a specific date",
          subtitle: "in units",
        },
      };
      return (
        <Chart
          chartType="Line"
          width="100%"
          height="600px"
          data={dataLine}
          options={options}
        />
      );


}
