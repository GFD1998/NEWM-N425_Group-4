import {settings} from "../config/config";
import {useState} from "react";
import {useAuth} from "./useAuth";

const UseFetch = () => {
    const [data, setData] = useState(null);
    const [error, setError] = useState(null);
    const [isLoading, setIsLoading] = useState(false);
    const {user} = useAuth();
    const baseURI = settings.baseApiUrl + '/menuitems';
    const abortCont = new AbortController();
    const signal = abortCont.signal;
    const handleResponse = (promise) => {
        promise
            .then ( async response => {
                if (!response.ok) {
                    const error = await response.json();
                    return Promise.reject(error);
                }
            return response.json();
        })
            .then(data => {
                setIsLoading(false);
                setError(null);
                setData(data);
            })
            .catch(err => {
                setIsLoading(false);
                if (err.name === 'AbortError') {
                    setError('Fetch aborted');
                } else {
                    setError(JSON.stringify(err));
                }
            });
    }
    const getAll = (id = null) => {
        setIsLoading(true);
        const url = (!id) ? baseURI : baseURI + "/" + id;
        const promise = fetch(url, {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                'Authorization': "Bearer " + user.jwt
            },
            signal: signal
        });
        handleResponse(promise);
    }
    const get = ($id) => {
        getAll($id);
    }
    const create = (body) => {
        setIsLoading(true);
        const promise = fetch(baseURI, {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                'Authorization': "Bearer " + user.jwt
            },
            body: JSON.stringify(body)
        });
        handleResponse(promise);
    }
    const update = (body) => {
        setIsLoading(true);
        const promise = fetch(baseURI + "/" + body.id, {
            method: 'PUT',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                'Authorization': "Bearer " + user.jwt
            },
            body: JSON.stringify(body)
        })
        handleResponse(promise);
    }
    const remove = (id) => {
        const promise = fetch(baseURI + "/" + id, {
            method: 'DELETE',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                'Authorization': "Bearer " + user.jwt
            }
        })
        handleResponse(promise);
    }
    const search = (query) => {
        const promise = fetch(baseURI + "?q=" + query, {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                'Authorization': "Bearer " + user.jwt
            },
            signal: signal
        });
        handleResponse(promise);
    }



    

    return {error, isLoading, data, get, getAll, update, remove, create, search};
}
export default UseFetch;