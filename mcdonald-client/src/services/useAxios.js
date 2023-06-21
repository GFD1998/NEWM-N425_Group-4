import axios from 'axios';
import {useState, useEffect} from 'react';

const UseAxios = (url,
                  method = "GET",
                  headers = {},
                  body = {}) => {
    headers = {
        ...{"Content-Type": "application/json"},
        ...headers
    };

    const [data, setData] = useState(null);
    const [error, setError] = useState(null);
    const [isLoading, setIsLoading] = useState(true);

    useEffect(() => {
        const controller = new AbortController;

        axios({
           url: url,
           method: method,
            headers: headers,
            data: body,
            timeout: 2000
        })
            .then(response => {
                setIsLoading(false);
                setError(null);
                setData(response.data);
            })
            .catch(error => {
                setIsLoading(false);
                if(error.response) {
                    setError(error.response)
                } else if (error.request) {
                    setError(error.request)
                } else {
                    setError("Error: ", error.message)
                }
            });
    }, [url]);

    return {data, isLoading, error};
};

export default UseAxios;