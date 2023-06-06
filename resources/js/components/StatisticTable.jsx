import { get, set } from "lodash";
import React, { useState, useEffect } from "react";
import { Chart } from "react-google-charts";
import Loader from "./Loader";
import Filter from "./Filter";

export default function ReportTable() {
    const [data, setDataLine] = useState([]);
    const [loader, setLoader] = useState(false);

    const basic_filter_options = {
        type: [],
        action: [],
        name: "",
        startDate: "",
        endDate: "",
    };
    useEffect(() => {
        getDataLine(basic_filter_options);
    }, []);
    const options = {
        title: "Company Performance",
        curveType: "function",
        legend: { position: "bottom" },
        pageSize: 15,
    };
    const getDataLine = (filter, callback) => {
        setLoader(true);
        fetch(`/api/statistic`, {
            method: "POST",
            body: JSON.stringify(filter),
            headers: {
                "Content-type": "application/json; charset=UTF-8",
            },
        })
            .then((response) => response.json())
            .then((data) => {
                setDataLine(data);
                setLoader(false);
                callback ? callback : "";
            });
    };
    return (
        <>
            <div></div>
            <Filter
                filter={getDataLine}
                noFilterOptions={basic_filter_options}
            />

            <Chart
                chartType="Table"
                width="fit-content"
                height="fit-content"
                data={data}
                options={options}
            />
            {loader && <Loader />}
        </>
    );
}
