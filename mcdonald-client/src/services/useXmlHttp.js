import {useState, useEffect} from 'react';

const UseXmlHttp = (url,
                    method = "GET",
                    headers = {}) => {
    headers = {
        ...{"Content-Type": "application/json"},
        ...headers
    };
    const [data, setData] = useState(null);
    const [error, setError] = useState(null);
    const [isLoading, setIsLoading] = useState(true);

    useEffect(() => {
        let request = new XMLHttpRequest();
        request.open(method, url, true);
        request.timeout = 2000;
        for(let name in headers) {
            request.setRequestHeader(name, headers[name]);
        }
        request.onload = () => {
            setIsLoading(false)
            if (request.status === 200) {
                setData(JSON.parse(request.response));
            } else {
                console.log(request)
                setError("Status: " + request.status + "; Error: " + request.statusText);
            }
        }
        request.ontimeout = () => {
            setIsLoading(false);
            setError("Error: The request has timed out.");
        }
        request.send();
    }, [url]);

    return {data, isLoading, error};
};

export default UseXmlHttp;