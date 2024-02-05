import { z } from "zod";

export class AuthValidator {
    
    static schema = z.object({
        email: 
            z.string({required_error: "Necessário preencher campo"}).email('E-mail inválido'),
        password: 
            z.string({required_error: "Necessário preencher campo"}).min(1, 'Necessário preencher campo'),
    });
}