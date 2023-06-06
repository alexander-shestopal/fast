import React, { useState } from "react";

export default function Filter({ filter, noFilterOptions }) {
    const actions = [
        "register",
        "login",
        "logout",
        "view_page",
        "button_click",
    ];
    const types = [
        "register",
        "login",
        "logout",
        "view_buy",
        "view_download",
        "click_buy",
        "click_download",
    ];
    const [filterOptions, setFilterOptions] = useState(noFilterOptions);

    const onChange = (e) => {
        const value = e.target.value;
        let filter = { ...filterOptions };

        if (e.target.type === "checkbox") {
            let array_of_options = [...filterOptions[e.target.name]];
            if (array_of_options.includes(value)) {
                const index = array_of_options.indexOf(value);
                array_of_options.splice(index, 1);
            } else {
                array_of_options.push(value);
            }

            filter[e.target.name] = array_of_options;
        } else {
            filter[e.target.name] = value;
        }
        setFilterOptions(filter);
    };

    const filterList = () => {
        filter(filterOptions, setFilterOptions(noFilterOptions));
    };
    return (
        <div>
            <ul className="row list-unstyled">
                <li className="col-4">
                    <div className="mb-4">
                        <h5 className="fw-bold">Date</h5>
                        <div className="d-flex justify-content-between">
                            <label htmlFor="from">from</label>
                            <input
                                onChange={onChange}
                                className=" ms-2 p-1"
                                id="from"
                                type="date"
                                name="startDate"
                                value={filterOptions.startDate}
                            />
                        </div>
                        <div className="d-flex justify-content-between">
                            <label htmlFor="from">to</label>
                            <input
                                onChange={onChange}
                                className=" ms-2 p-1"
                                id="to"
                                type="date"
                                name="endDate"
                                value={filterOptions.endDate}
                            />
                        </div>
                    </div>
                    <div>
                        <h5 className="fw-bold">Name</h5>
                        <input
                            className="w-100 p-1"
                            type="text"
                            name="name"
                            value={filterOptions.name}
                            onChange={onChange}
                        />
                    </div>
                </li>
                <li className="col-4">
                    <h5 className="fw-bold">Action</h5>
                    <ul className="list-unstyled">
                        {actions.map((action) => (
                            <li
                                className="p-1 d-flex align-items-center"
                                key={action + "action"}
                            >
                                {" "}
                                <input
                                    className="me-2"
                                    type="checkbox"
                                    id={action + "action"}
                                    name="action"
                                    value={action}
                                    onChange={onChange}
                                    checked={filterOptions.action.includes(
                                        action
                                    )}
                                />
                                <label htmlFor={action + "action"}>
                                    {" "}
                                    {action}
                                </label>
                            </li>
                        ))}
                    </ul>
                </li>
                <li className="col-4">
                    <h5 className="fw-bold">Type</h5>
                    <ul className="list-unstyled">
                        {types.map((type) => (
                            <li
                                className="p-1 d-flex align-items-center"
                                key={type + "action"}
                            >
                                {" "}
                                <input
                                    className="me-2"
                                    id={type + "type"}
                                    type="checkbox"
                                    name="type"
                                    value={type}
                                    onChange={onChange}
                                    checked={filterOptions.type.includes(type)}
                                />
                                <label htmlFor={type + "type"}> {type}</label>
                            </li>
                        ))}
                    </ul>
                </li>
            </ul>
            <div className="d-flex my-4 justify-content-center">
                <button onClick={filterList} className="btn btn-primary">
                    Filter
                </button>
            </div>
        </div>
    );
}
