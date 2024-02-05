import { z } from "zod";

export class UserValidator {
    
    static _onlyNumber = new RegExp(
        /^([+]?[\s0-9]+)?(\d{3}|[(]?[0-9]+[)])?([-]?[\s]?[0-9])+$/
    );
        
    static _onlyString = new RegExp(
        /^([+]?[\sa-z]+)?(\d{3}|[(]?[a-z]+[)])?([-]?[\s]?[a-z])+$/
    );

    static schema = z.object({
        login: 
            z.string({required_error: "Necessário preencher campo"}).min(5, "Mínimo de 5 caractéres").regex(this._onlyString, 'Apenas letras minúsculas são permitidas'),
        email: 
            z.string({required_error: "Necessário preencher campo"}).email('E-mail inválido'),
        password: 
            z.string({required_error: "Necessário preencher campo"}).min(8, 'Mínimo 8 caracters, números e letras'),
        full_name: 
            z.string({required_error: "Necessário preencher campo"}).min(4, 'Nome inválido'),
        phone: 
            z.string({required_error: "Necessário preencher campo"}).regex(this._onlyNumber, 'Apenas números').length(11, "Celular inválido"),
        birth: 
            z.string({required_error: "Necessário preencher campo"}),
        cep: 
            z.string({required_error: "Necessário preencher campo"}).regex(this._onlyNumber, 'Apenas números').length(8, 'Cep inválido'),
        address: 
            z.string({required_error: "Necessário preencher campo"}).min(2, "Campo inválido"),
        district: 
            z.string({required_error: "Necessário preencher campo"}).min(2, "Campo inválido"),
        city: 
            z.string({required_error: "Necessário preencher campo"}).min(2, "Campo inválido"),
        state: 
            z.string({required_error: "Necessário preencher campo"}).min(2, "Campo inválido"),
    })
}